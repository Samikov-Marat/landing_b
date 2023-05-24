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
use Illuminate\View\View;


class LocalOfficeController extends Controller
{
    const SORT_STEP = 10;

    public function index(Site $site): View
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

    public function edit(Site $site, LocalOffice $localOffice): View
    {
        abort_if($localOffice->site_id !== $site->id, 404);

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
        abort_if($localOffice->site_id !== $site->id, 404);

        if (!$localOffice) {
            $localOffice = new LocalOffice();
        }

        $localOffice->site_id = $site->id;
        $localOffice->code = $request->input('code', '');
        $localOffice->subdomain = trim($request->input('subdomain', ''));
        $localOffice->map_preset = trim($request->input('map_preset', ''));
        $localOffice->utm_tag = $request->input('utm_tag', '');
        $localOffice->utm_value = $request->input('utm_value', '');
        $localOffice->category = $request->input('category', '');
        $localOffice->disabled = $request->has('disabled');
        $localOffice->franchisee_id = (int)$request->get('franchisee_id') ?: null;
        $localOffice->sort = LocalOffice::where('site_id', $site->id)
                ->max('sort') + self::SORT_STEP;
        $localOffice->save();

        $site->load('languages');
        $localOfficeRepository = LocalOfficeRepository::getInstance($localOffice);

        foreach ($site->languages as $language) {
            $localOfficeText = $localOfficeRepository->getOrMake($language->id);
            $localOfficeText->name = $request['name'][$language->id] ?? '';
            $localOfficeText->address = $request['address'][$language->id] ?? '';
            $localOfficeText->path = $request['path'][$language->id] ?? '';
            $localOfficeText->worktime = $request['worktime'][$language->id] ?? '';
            $localOfficeText->save();
        }

        $oldPhones = [];
        if ($request->has('phone_old')) {
            $oldPhones = $request->get('phone_old');
            foreach ($oldPhones as $id => $phone) {
                $localOfficePhone = $localOfficeRepository->getPhone($id);
                $localOfficePhone->phone_text = $phone['phone_text'] ?? '';
                $localOfficePhone->phone_value = $phone['phone_value'] ?? '';
                $localOfficePhone->show_at_footer = $phone['show_at_footer'] ?? false;
                $localOfficePhone->save();
            }
        }
        $localOfficeRepository->deleteOtherPhones(array_keys($oldPhones));

        if ($request->has('phone_new')) {
            $newPhones = $request->get('phone_new');
            foreach ($newPhones as $phone) {
                $localOfficePhone = $localOfficeRepository->makePhone();
                $localOfficePhone->phone_text = $phone['phone_text'] ?? '';
                $localOfficePhone->phone_value = $phone['phone_value'] ?? '';
                $localOfficePhone->show_at_footer = $phone['show_at_footer'] ?? false;
                $localOfficePhone->sort = $localOfficeRepository->getNextPhoneSort();
                $localOfficePhone->save();
            }
        }


        $oldEmails = [];
        if ($request->has('email_old')) {
            $oldEmails = $request->get('email_old');
            foreach ($oldEmails as $id => $email) {
                $localOfficeEmail = $localOfficeRepository->getEmail($id);
                $localOfficeEmail->email = $email['email'] ?? '';
                $localOfficeEmail->show_at_footer = $email['show_at_footer'] ?? false;

                $localOfficeEmail->save();
            }
        }
        $localOfficeRepository->deleteOtherEmails(array_keys($oldEmails));

        if ($request->has('email_new')) {
            $newEmails = $request->get('email_new');
            foreach ($newEmails as $email) {
                $localOfficeEmail = $localOfficeRepository->makeEmail();
                $localOfficeEmail->email = $email['email'] ?? '';
                $localOfficeEmail->show_at_footer = $email['show_at_footer'] ?? false;
                $localOfficeEmail->sort = $localOfficeRepository->getNextEmailSort();
                $localOfficeEmail->save();
            }
        }
        return response()->redirectToRoute('admin.local_offices.index', ['site' => $site]);
    }

    public function delete(Site $site, LocalOffice $localOffice): RedirectResponse
    {
        abort_if($localOffice->site_id !== $site->id, 404);

        $localOffice->delete();
        return response()->redirectToRoute('admin.local_offices.index', ['site' => $site]);
    }

    public function move(
        LocalOfficeMoveRequest $request,
        Site $site,
        LocalOffice $localOffice
    ): RedirectResponse {
        abort_if($localOffice->site_id !== $site->id, 404);

        $direction = $request->input('direction', '');
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
