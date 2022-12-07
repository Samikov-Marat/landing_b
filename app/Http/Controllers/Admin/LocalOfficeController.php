<?php

namespace App\Http\Controllers\Admin;

use App\Classes\LocalOfficeRepository;
use App\Franchisee;
use App\Http\Controllers\Controller;
use App\LocalOffice;
use App\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class LocalOfficeController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with(
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
                                           'sort'
                                       ])
                            ->orderBy('sort');
                    },
                    'localOffices.localOfficeTexts' => function ($query) {
                        $query->select(['id', 'local_office_id', 'name']);
                    },
                    'localOffices.franchisee' => function ($query) {
                        $query->select(['id', 'name', 'description']);
                    },

                ]
            )
            ->find($request->input('site_id'));
        $franchisees = Franchisee::select(['id', 'name', 'description'])
            ->orderBy('name')
            ->get();
        return view('admin.local_offices.index')
            ->with('site', $site)
            ->with('franchisees', $franchisees);
    }

    public function edit(Request $request, $id = null)
    {
        if (isset($id)) {
            $localOffice = LocalOffice::select(
                ['id', 'code', 'subdomain', 'map_preset', 'utm_tag', 'utm_value', 'category', 'site_id', 'disabled','franchisee_id',]
            )
                ->with(
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
                                'phone_value'
                            )->orderby('sort', 'ASC');
                        },
                        'localOfficeEmails' => function ($query) {
                            $query->select(
                                'id',
                                'local_office_id',
                                'email'
                            )->orderby('sort', 'ASC');
                        },
                    ]
                )
                ->find($id);
            $siteId = $localOffice->site_id;
        } else {
            $localOffice = null;
            $siteId = $request->input('site_id');
        }
        $site = Site::select('id', 'name', 'domain')
            ->with('languages')
            ->find($siteId);

        $franchisees = Franchisee::select(['id', 'name', 'description'])
            ->orderBy('name')
            ->get();

        return view('admin.local_offices.form')
            ->with('site', $site)
            ->with('localOffice', $localOffice)
            ->with('franchisees', $franchisees);
    }

    public function save(Request $request): RedirectResponse
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $localOffice = LocalOffice::find($request->input('id'));
        } else {
            $localOffice = new LocalOffice();
        }
        $localOffice->site_id = $request->input('site_id');
        $localOffice->code = $request->input('code') ?? '';
        $localOffice->subdomain = trim($request->input('subdomain', ''));
        $localOffice->map_preset = trim($request->input('map_preset', ''));
        $localOffice->utm_tag = $request->input('utm_tag') ?? '';
        $localOffice->utm_value = $request->input('utm_value') ?? '';
        $localOffice->category = $request->input('category') ?? '';
        $localOffice->disabled = $request->has('disabled');
        if (!$isEditMode) {
            $localOffice->sort = LocalOffice::where('site_id', $localOffice->site_id)->max('sort') + self::SORT_STEP;
        }
        if ($request->has('franchisee_id') && ($request->input('franchisee_id') === 'null')) {
            $localOffice->franchisee_id = null;
        } elseif ($request->has('franchisee_id')) {
            $localOffice->franchisee_id = $request->input('franchisee_id');
        }
        $localOffice->save();

        $site = Site::select('id', 'name', 'domain')
            ->with('languages')
            ->find($localOffice->site_id);

        $localOfficeRepository = LocalOfficeRepository::getInstance($localOffice);
        foreach ($site->languages as $language) {
            $localOfficeText = $localOfficeRepository->getTextByLanguage($language->id);
            $localOfficeText->name = $request->input('name')[$language->id] ?? '';
            $localOfficeText->address = $request->input('address')[$language->id] ?? '';
            $localOfficeText->path = $request->input('path')[$language->id] ?? '';
            $localOfficeText->worktime = $request->input('worktime')[$language->id] ?? '';
            $localOfficeText->save();
        }

        $oldPhones = [];
        if ($request->has('phone_old')) {
            $oldPhones = $request->input('phone_old');
            foreach ($oldPhones as $id => $phone) {
                $localOfficePhone = $localOfficeRepository->getPhone($id);
                $localOfficePhone->phone_text = $phone['phone_text'];
                $localOfficePhone->phone_value = $phone['phone_value'];
                $localOfficePhone->save();
            }
        }
        $localOfficeRepository->deleteOtherPhones(array_keys($oldPhones));

        if ($request->has('phone_new')) {
            $newPhones = $request->input('phone_new');
            foreach ($newPhones as $phone) {
                $localOfficePhone = $localOfficeRepository->makePhone();
                $localOfficePhone->phone_text = $phone['phone_text'];
                $localOfficePhone->phone_value = $phone['phone_value'];
                $localOfficePhone->sort = $localOfficeRepository->getNextPhoneSort();
                $localOfficePhone->save();
            }
        }


        $oldEmails = [];
        if ($request->has('email_old')) {
            $oldEmails = $request->input('email_old');
            foreach ($oldEmails as $id => $email) {
                $localOfficeEmail = $localOfficeRepository->getEmail($id);
                $localOfficeEmail->email = $email['email'];

                $localOfficeEmail->save();
            }
        }
        $localOfficeRepository->deleteOtherEmails(array_keys($oldEmails));

        if ($request->has('email_new')) {
            $newEmails = $request->input('email_new');
            foreach ($newEmails as $email) {
                $localOfficeEmail = $localOfficeRepository->makeEmail();
                $localOfficeEmail->email = $email['email'];
                $localOfficeEmail->sort = $localOfficeRepository->getNextEmailSort();
                $localOfficeEmail->save();
            }
        }
        return response()->redirectToRoute('admin.local_offices.index', ['site_id' => $localOffice->site_id]);
    }

    public function delete(Request $request): RedirectResponse
    {
        $localOffice = LocalOffice::select('id', 'site_id')
            ->find($request->input('id'));
        $site_id = $localOffice->site_id;
        $localOffice->delete();
        return response()->redirectToRoute('admin.local_offices.index', ['site_id' => $site_id]);
    }

    public function move(Request $request): RedirectResponse
    {
        $localOffice = LocalOffice::select('id', 'site_id', 'sort')
            ->find($request->input('id'));

        $direction = $request->input('direction');
        if ('up' == $direction) {
            $sign = '<';
            $orderByDirection = 'desc';
        }
        if ('down' == $direction) {
            $sign = '>';
            $orderByDirection = 'asc';
        }
        $otherLocalOffice = LocalOffice::select('id', 'sort')
            ->where('site_id', $localOffice->site_id)
            ->where('sort', $sign, $localOffice->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $localOffice->sort;
        $localOffice->sort = $otherLocalOffice->sort;
        $localOffice->save();
        $otherLocalOffice->sort = $sort;
        $otherLocalOffice->save();

        return response()->redirectToRoute('admin.local_offices.index', ['site_id' => $localOffice->site_id]);
    }
}
