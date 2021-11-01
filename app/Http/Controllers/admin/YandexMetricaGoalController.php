<?php

namespace App\Http\Controllers\admin;

use App\Classes\Admin\YandexMetricaCountersRepository;
use App\Classes\Admin\YandexMetricaGoalRepository;
use App\Classes\Admin\YandexTokenRepository;
use App\Http\Controllers\Controller;
use App\YandexMetricaGoal;
use App\YandexToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class YandexMetricaGoalController extends Controller
{
    const PER_PAGE = 10;

    public function index()
    {
        $yandexMetricaGoals = YandexMetricaGoal::select('id', 'name', 'description', 'image')
            ->orderBy('id')
            ->paginate(static::PER_PAGE);
        return view('admin.yandex_metrica_goals.index')
            ->with('yandexMetricaGoals', $yandexMetricaGoals);
    }


    public function edit($id = null)
    {
        if (isset($id)) {
            $yandexMetricaGoal = YandexMetricaGoal::select('id', 'name', 'description', 'image')
                ->find($id);
        } else {
            $yandexMetricaGoal = null;
        }

        return view('admin.yandex_metrica_goals.form')
            ->with('yandexMetricaGoal', $yandexMetricaGoal);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $yandexMetricaGoal = YandexMetricaGoal::find($request->input('id'));
        } else {
            $yandexMetricaGoal = new YandexMetricaGoal();

            $yandexMetricaGoal->project_id = $request->input('project_id');
        }
        $yandexMetricaGoal->name = $request->input('name');
        $yandexMetricaGoal->description = $request->input('description');
        $yandexMetricaGoal->save();
        return response()->redirectToRoute('admin.yandex_metrica_goals.index');
    }

    public function delete(Request $request)
    {
        $yandexMetricaGoal = YandexMetricaGoal::find($request->input('id'));
        $yandexMetricaGoal->delete();
        return response()->redirectToRoute('admin.yandex_metrica_goals.index');
    }

    public function yandexAuth()
    {
        $tokens = YandexToken::select(['id', 'access_token', 'refresh_token', 'login', 'received_at'])
            ->orderBy('received_at')
            ->get();
        return view('admin.yandex_metrica_goals.yandex_auth')
            ->with('tokens', $tokens);
    }


    public function saveYandexAuth(Request $request)
    {
        if ($request->has('error', 'error_description')) {
            return $request->input('error_description');
        }
        if ($request->has('error')) {
            return $request->input('error');
        }

        $token_id = YandexTokenRepository::getInstance($request->input('code'))
            ->receiveToken();

        return response()->redirectToRoute('admin.yandex_metrica_goals.yandex_form', ['token_id' => $token_id]);
    }

    public function yandexForm(Request $request)
    {
        $token = YandexToken::select(['id', 'access_token', 'refresh_token', 'login', 'received_at'])
            ->findOrFail($request->input('token_id'));

        $counters = YandexMetricaCountersRepository::getInstance($token->access_token)
            ->getCounters();

        return view('admin.yandex_metrica_goals.yandex_form')
            ->with('token', $token)
            ->with('counters', $counters);
    }

    public function cloneGoalsToYandex(Request $request)
    {
        if (!$request->has('counter_id')) {
            return response()->redirectToRoute('admin.yandex_metrica_goals.index');
        }
        $token = YandexToken::select(['id', 'access_token', 'refresh_token', 'login', 'received_at'])
            ->findOrFail($request->input('token_id'));
        if ($request->input('project_id') != 1) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $goals = YandexMetricaGoal::select(['id', 'name', 'description'])
            ->get();

        foreach ($request->input('counter_id') as $counterId) {
            foreach ($goals as $goal) {
                YandexMetricaGoalRepository::getInstance($token->access_token)
                    ->setCounter($counterId)
                    ->create($goal);
            }
        }

        return response()->redirectToRoute('admin.yandex_metrica_goals.index');
    }

}
