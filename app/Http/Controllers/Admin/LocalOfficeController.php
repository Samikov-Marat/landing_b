<?php

namespace App\Http\Controllers\Admin;

use App\Classes\LocalOfficeRepository;
use App\Franchisee;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocalOfficeMoveRequest;
use App\Http\Requests\LocalOfficeRequest;
use App\LocalOffice;
use App\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class LocalOfficeController extends Controller
{
    const SORT_STEP = 10;

    public function index(Site $site)
    {
        $site->with(
                [
                    'localOffices' => function ($query) {
                        $query->select([
                            'id',
                            'site_id',
                            'code',
                            'subdomain',
                            'utm_tag',
                            'utm_value',
                            'category',
                            'disabled',
                            'franchisee_id',
                            'sort',
                        ]);
                    },
                    'localOffices.localOfficeTexts' => function ($query) {
                        $query->select(['id', 'local_office_id', 'name']);
                    },
                    'localOffices.franchisee' => function ($query) {
                        $query->select(['id', 'name', 'description']);
                    },

                ]
            );

        $franchisees = Franchisee::select(['id', 'name', 'description'])
            ->orderBy('name')
            ->get();

        return view('admin.local_offices.index')
            ->with('site', $site)
            ->with('franchisees', $franchisees);
    }

    public function edit(Site $site, LocalOffice $localOffice)
    {
        $localOffice->with(
                [
                    'localOfficeTexts' => function ($query) {
                        $query->select(
                            'id',
                            'local_office_id',
                            'name',
                            'language_id',
                            'address',
                            'path',
                            'worktime'
                        );
                    },
                    'localOfficePhones' => function ($query) {
                        $query->select(
                            'id',
                            'local_office_id',
                            'phone_text',
                            'phone_value',
                            'show_at_footer'
                        );
                    },
                    'localOfficeEmails' => function ($query) {
                        $query->select(
                            'id',
                            'local_office_id',
                            'email',
                            'show_at_footer'
                        );
                    },
                ]
            );

        $site->with('languages');

        $franchisees = Franchisee::select(['id', 'name', 'description'])
            ->orderBy('name')
            ->get();

        return view('admin.local_offices.form')
            ->with('site', $site)
            ->with('localOffice', $localOffice)
            ->with('franchisees', $franchisees);
    }

    public function update(
        LocalOfficeRequest $request,
        Site $site,
        LocalOffice $localOffice = null
    ): RedirectResponse {
        $validated = collect($request->validated());

        if (!$localOffice) {
            $localOffice = new LocalOffice();
        }

        $localOffice->site_id = $site->id;
        $localOffice->code = $validated->get('code');
        $localOffice->subdomain = $validated->get('subdomain');
        $localOffice->map_preset = $validated->get('map_preset');
        $localOffice->utm_tag = $validated->get('utm_tag');
        $localOffice->utm_value = $validated->get('utm_value');
        $localOffice->category = $validated->get('category');
        $localOffice->disabled = $validated->has('disabled');
        $localOffice->franchisee_id = (int)$validated->get('franchisee_id') ?: null;
        $localOffice->sort = LocalOffice::where('site_id', $site->id)
                ->max('sort') + self::SORT_STEP;
        $localOffice->save();

        $site->load('languages');

        $localOfficeRepository = LocalOfficeRepository::getInstance($localOffice);

        foreach ($site->languages as $language) {
            $localOfficeText = $localOfficeRepository->getOrMake($language->id);
            $localOfficeText->name = $validated['name'][$language->id] ?? '';
            $localOfficeText->address = $validated['address'][$language->id] ?? '';
            $localOfficeText->path = $validated['path'][$language->id] ?? '';
            $localOfficeText->worktime = $validated['worktime'][$language->id] ?? '';
            $localOfficeText->save();
        }

        $oldPhones = [];
        if ($validated->has('phone_old')) {
            $oldPhones = $validated->get('phone_old');
            foreach ($oldPhones as $id => $phone) {
                $localOfficePhone = $localOfficeRepository->getPhone($id);
                $localOfficePhone->phone_text = $phone['phone_text'] ?? '';
                $localOfficePhone->phone_value = $phone['phone_value'] ?? '';
                $localOfficePhone->show_at_footer = $phone['show_at_footer'] ?? null;
                $localOfficePhone->save();
            }
        }
        $localOfficeRepository->deleteOtherPhones(array_keys($oldPhones));

        if ($validated->has('phone_new')) {
            $newPhones = $validated->get('phone_new');
            foreach ($newPhones as $phone) {
                $localOfficePhone = $localOfficeRepository->makePhone();
                $localOfficePhone->phone_text = $phone['phone_text'] ?? '';
                $localOfficePhone->phone_value = $phone['phone_value'] ?? '';
                $localOfficePhone->show_at_footer = $phone['show_at_footer'] ?? null;
                $localOfficePhone->sort = $localOfficeRepository->getNextPhoneSort();
                $localOfficePhone->save();
            }
        }


        $oldEmails = [];
        if ($validated->has('email_old')) {
            $oldEmails = $validated->get('email_old');
            foreach ($oldEmails as $id => $email) {
                $localOfficeEmail = $localOfficeRepository->getEmail($id);
                $localOfficeEmail->email = $email['email'] ?? '';
                $localOfficeEmail->show_at_footer = $email['show_at_footer'] ?? null;

                $localOfficeEmail->save();
            }
        }
        $localOfficeRepository->deleteOtherEmails(array_keys($oldEmails));

        if ($validated->has('email_new')) {
            $newEmails = $validated->get('email_new');
            foreach ($newEmails as $email) {
                $localOfficeEmail = $localOfficeRepository->makeEmail();
                $localOfficeEmail->email = $email['email'] ?? '';
                $localOfficeEmail->show_at_footer = $email['show_at_footer'] ?? null;
                $localOfficeEmail->sort = $localOfficeRepository->getNextEmailSort();
                $localOfficeEmail->save();
            }
        }
        return response()->redirectToRoute('admin.local_offices.index', ['site' => $site]);
    }

    public function delete(Site $site, LocalOffice $localOffice): RedirectResponse
    {
        $localOffice->delete();
        return response()->redirectToRoute('admin.local_offices.index', ['site' => $site]);
    }

    public function move(
        LocalOfficeMoveRequest $request,
        Site $site,
        LocalOffice $localOffice
    ): RedirectResponse {
        $validated = $request->validated();
        $direction = $validated['direction'];
        if ('up' == $direction) {
            $sign = '<';
            $orderByDirection = 'desc';
        }
        if ('down' == $direction) {
            $sign = '>';
            $orderByDirection = 'asc';
        }
        $otherLocalOffice = LocalOffice::select('id', 'sort')
            ->where('site_id', $site->id)
            ->where('sort', $sign, $localOffice->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $localOffice->sort;
        $localOffice->sort = $otherLocalOffice->sort;
        $localOffice->save();
        $otherLocalOffice->sort = $sort;
        $otherLocalOffice->save();

        return response()->redirectToRoute('admin.local_offices.index',
            ['site' => $site]);
    }
}
