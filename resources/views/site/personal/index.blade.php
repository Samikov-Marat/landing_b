<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@d('personal_1')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap" rel="stylesheet">
            <link href="/personal/assets/vendor/owl.carousel.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="/personal/assets/css/app.css?cssv6">
            <link rel="stylesheet" href="/universal2/custom.css?v=2">

    </head>
    <body class="site-theme">
    <div class="body-wrapper js-body_wrapper office-page-wrapper ">
        <div class="fullscreen-modal-background js-fade_background "></div>
        <header class="header-shadow">
            <div class="header office-page-header">
    <div class="header__content">
        <a href="/" class="logo-cdek header__logo office-page-header__logo"></a>
        <div class="office-page-header__office">
            <div>@d('personal_2')</div>
            <div class="office-page-header__office-city">@d('personal_3')</div>
        </div>
        <div class="office-page-header__left">

            @foreach($site->languages as $languageItem)
                @if($language->id != $languageItem->id)
                    <div><a class="header__language-selector" href="{!! route('site.show_page', ['languageUrl' => $languageItem->uri, 'pageUrl' => $page->url]) !!}">{{ \Str::upper($languageItem->shortname) }}</a></div>
                @endif
            @endforeach

            <a href="#calculator" class="office-page-button office-page-header__button_fc office-page-button_type_calculate office-page-header__button">@d('personal_5')</a>
            <a href="#tracking" class="office-page-button office-page-button_type_search office-page-header__button">@d('personal_6')</a>
        </div>
        <div class="header__right">
            <div class="header-contact">
                <div class="header-contact__content office-page-header__phone">
                    <a class="header-contact__phone" href="tel:{{ $dictionary['personal_phone_value'] }}">@d('personal_7')</a>
                </div>
            </div>
            <a href="#feedback" class="office-page-header__contact">@d('personal_8')</a>
        </div>
        <div class="menu-mobile js-menu-open-button"></div>
    </div>
</div>
<div class="fullscreen-modal-background js-fade_background "></div>
<div class="header-mobile-open-wrapper">
    <div class="header-mobile-open office-page-mobile-menu js-menu-container transition_slide-right ">
        <div class="header-mobile-open__close js-menu-close-button"></div>
        <div class="header__language-selector office-page-mobile-menu__lang">@d('personal_9')</div>
        <div class="office-page-mobile-menu__buttons">
            <a href="#" class="office-page-button office-page-button_type_calculate office-page-mobile-menu__button">@d('personal_10')</a>
            <a href="#" class="office-page-button office-page-button_type_search office-page-mobile-menu__button">@d('personal_11')</a>
        </div>
        <div class="office-page-mobile-menu__text">
            @d('personal_12')<br />
            @d('personal_13')
        </div>
        <a href="#" class="office-page-mobile-menu__phone">@d('personal_14')</a>
        <div class="office-page-mobile-menu__email-container">
            <a href="#" class="office-page-mobile-menu__email">@d('personal_15')</a>
        </div>
        <a href="#" class="office-page-mobile-menu__contact">@d('personal_16')</a>
    </div>
</div>
        </header>

    <div class="office-page-poster">
        <div class="office-page-poster__container">
            <picture class="office-page-poster__image">
                <source srcset="/request/images/poster-mobile.jpg, /request/images/poster-mobile-2x.jpg 2x" media="(max-width: 480px)">
                <source srcset="/request/images/poster-tablet.jpg, /request/images/poster-tablet-2x.jpg 2x" media="(min-width: 480px) and (max-width: 1199px)">
                <source srcset="/request/images/poster-desktop.jpg">
                <img src="/personal/img-op/poster-desktop.jpg" />
            </picture>
            <div class="office-page-poster__content">
                <div>
                    <div class="office-page-poster__title">@d('personal_17')</div>
                    <div class="office-page-poster__description">@d('personal_18')</div>
                </div>
                <div class="office-page-poster__advantages">
                    <div class="office-page-poster__adv-col">
                        <div class="office-page-poster__adv-row office-page-poster__adv-row_outside">
                            <div class="office-page-poster__adv office-page-poster__adv_green">
                                <div class="office-page-poster__adv-icon office-page-poster__adv-icon_customs"></div>
                                <div>@d('personal_19')</div>
                            </div>
                        </div>
                        <div class="office-page-poster__adv-row">
                            <div class="office-page-poster__adv">
                                <div class="office-page-poster__adv-icon office-page-poster__adv-icon_year"></div>
                                <div class="office-page-poster__number">@d('personal_20')</div>
                                <div>@d('personal_21')</div>
                            </div>
                        </div>
                        <div class="office-page-poster__adv-row">
                            <div class="office-page-poster__adv office-page-poster__adv_yellow">
                                <div class="office-page-poster__adv-icon office-page-poster__adv-icon_delivery"></div>
                                <div>@d('personal_22')</div>
                            </div>
                        </div>
                    </div>
                    <div class="office-page-poster__adv-col">
                        <div class="office-page-poster__adv-row">
                            <div class="office-page-poster__adv office-page-poster__adv_green">
                                <div class="office-page-poster__adv-icon office-page-poster__adv-icon_pvz"></div>
                                <div class="office-page-poster__number">@d('personal_23')</div>
                                <div>@d('personal_24')</div>
                            </div>
                        </div>
                        <div class="office-page-poster__adv-row">
                            <div class="office-page-poster__adv">
                                <div class="office-page-poster__adv-icon office-page-poster__adv-icon_world"></div>
                                <div class="office-page-poster__number">@d('personal_25')</div>
                                <div>@d('personal_26')</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="office-page-services screen-content">
        <div class="office-page__heading2 office-page__heading2_centered">@d('personal_27')</div>
        <div class="office-page-services__main owl-carousel">
            <div class="office-page-services__main-item">
                <div class="office-page-services__main-item-head office-page-services__main-item-head_shop">
                    <div class="office-page-services__main-item-counter">@d('personal_28')</div>
                </div>
                <div class="office-page-services__main-item-body">
                    @d('personal_29')
                </div>
            </div>
            <div class="office-page-services__main-item">
                <div class="office-page-services__main-item-head office-page-services__main-item-head_courier">
                    <div class="office-page-services__main-item-counter">@d('personal_30')</div>
                </div>
                <div class="office-page-services__main-item-body">
                    @d('personal_31')
                </div>
            </div>
            <div class="office-page-services__main-item">
                <div class="office-page-services__main-item-head office-page-services__main-item-head_forward">
                    <div class="office-page-services__main-item-counter">@d('personal_32')</div>
                </div>
                <div class="office-page-services__main-item-body">
                    @d('personal_33')
                </div>
            </div>
            <div class="office-page-services__main-item">
                <div class="office-page-services__main-item-head office-page-services__main-item-head_post">
                    <div class="office-page-services__main-item-counter">@d('personal_34')</div>
                </div>
                <div class="office-page-services__main-item-body">
                    @d('personal_35')
                </div>
            </div>
        </div>
        <div class="office-page__heading3 office-page__heading3_centered">@d('personal_36')</div>
        <div class="office-page-services__secondary">
            <div class="office-page-services__secondary-item">
                <div class="office-page-services__secondary-item-title">@d('personal_37')</div>
                <div>
                    @d('personal_38')
                </div>
            </div>
            <div class="office-page-services__secondary-item">
                <div class="office-page-services__secondary-item-title">@d('personal_39')</div>
                <div>
                    @d('personal_40')
                </div>
            </div>
            <div class="office-page-services__secondary-item">
                <div class="office-page-services__secondary-item-title">@d('personal_41')</div>
                <div>
                    @d('personal_42')
                </div>
            </div>
        </div>
    </div>
    <div class="office-page-presentation">
        <div class="office-page-presentation__content">
            <div class="office-page-presentation__info">
                <div class="office-page-presentation__title">@d('personal_43')</div>
                <div class="office-page-presentation__download">@d('personal_44')</div>
            </div>
            <div class="office-page-presentation__img-container">
                <picture>
                    <source srcset="/personal/img-op/pr-girl-tablet.jpg, /personal/img-op/pr-girl-tablet-2x.jpg 2x" media="(min-width: 480px) and (max-width: 1199px)">
                    <source srcset="/personal/img-op/pr-girl.jpg, /personal/img-op/pr-girl-2x.jpg 2x">
                    <img src="/personal/img-op/pr-girl.jpg" />
                </picture>
            </div>
        </div>
    </div>
    <div class="office-page-offices">
        <div class="content">
            <div class="office-page__heading2 office-page-offices__heading">@d('personal_45')</div>
            <div class="office-page-offices__cmenu">
                <div class="office-page-offices__cmenu-item office-page-offices__cmenu-item_active">@d('personal_46')</div>
            </div>
            <div class="submenu office-page-offices__submenu">
                <div class="submenu__content">
                    @php
                    $extraClass = 'submenu__item_active';
                    @endphp
                    @foreach($site->localOffices as $localOffice)
                        <div class="submenu__item {{ $extraClass }} js-office-name" data-id="{{ $localOffice->id }}">{{ $localOffice->localOfficeTexts->first()->name  }}</div>
                        @php
                            $extraClass = '';
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <div class="office-page-offices__content">
            <div class="office-page-offices__side-left">
                @php
                    $extraClass = '';
                @endphp
                @foreach($site->localOffices as $localOffice)
                <div class="office-page-offices__left-content {{ $extraClass }} js-office-body" data-id="{{ $localOffice->id }}">
                    <div class="office-page-offices__title">@d('personal_51')</div>
                    <div class="office-page-offices__info office-page-offices__info_road">
                        <div>{{ $localOffice->localOfficeTexts->first()->address  }}</div>
                        @if($localOffice->localOfficeTexts->first()->path)
                            <div class="office-page-offices__info-desc">{{ $localOffice->localOfficeTexts->first()->path }}</div>
                        @endif
                    </div>
                    <div class="office-page-offices__info office-page-offices__info_time">
                        <div>
                            {{ nl2br(e($localOffice->localOfficeTexts->first()->worktime)) }}
                        </div>
                    </div>
                    <div class="office-page-offices__info office-page-offices__info_phone">
                        <div>
                            @foreach($localOffice->localOfficePhones as $localOfficePhone)
                                <a class="office-page-offices__info-phone" href="tel:{{ $localOfficePhone->phone_value }}">{{ $localOfficePhone->phone_text }}</a><br>
                            @endforeach
                        </div>
                        <div>
                            @foreach($localOffice->localOfficeEmails as $localOfficeEmail)
                                <a class="office-page-offices__info-email" href="mailto:{{ $localOfficeEmail->email }}">{{ $localOfficeEmail->email }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @php
                    $extraClass = 'hidden';
                @endphp
                @endforeach

            </div>
            <div class="office-page-offices__side-right">
                <div class="office-page-offices__photos owl-carousel">
                    @if($site->localOffices->isNotEmpty())
                        @foreach($site->localOffices->first()->localOfficePhotos as $photo)
                            <picture class="office-page-poster__image">
                                <source srcset="{{ Storage::disk('local_office_photos')->url($photo->mobile) }}, {{ Storage::disk('local_office_photos')->url($photo->mobile2) }} 2x" media="(max-width: 480px)">
                                <source srcset="{{ Storage::disk('local_office_photos')->url($photo->tablet) }}, {{ Storage::disk('local_office_photos')->url($photo->tablet2) }} 2x" media="(min-width: 480px) and (max-width: 1199px)">
                                <source srcset="{{ Storage::disk('local_office_photos')->url($photo->sample) }}, {{ Storage::disk('local_office_photos')->url($photo->sample2) }} 2x">
                                <img src="{{ Storage::disk('local_office_photos')->url($photo->sample) }}" />
                            </picture>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

    @if($site->ourWorkers->isNotEmpty())
    <div class="office-page-team">
        <div class="office-page__heading2 office-page__heading2_centered">@d('personal_58')</div>
        <div class="office-page-team__text">@d('personal_59')<br />@d('personal_60')</div>
        <div class="office-page-team__content owl-carousel">
            @foreach($site->ourWorkers as $ourWorker)
                <div class="office-page-team__item">
                    <img src="{{ Storage::disk('our_worker_photos')->url($ourWorker->photo) }}" class="office-page-team__photo" />
                    @if($ourWorker->ourWorkerTexts->isnotEmpty())
                        <div class="office-page-team__name">{{ $ourWorker->ourWorkerTexts->first()->name }}</div>
                        <div>{{ $ourWorker->ourWorkerTexts->first()->post }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif



    <div class="office-page__calculator">
        @include('site.universal2.calculator_block')
    </div>
    <div class="office-page-track" id="tracking">
        @include('site.personal.tracking')

    </div>
    <div class="content">
        <div class="office-page__heading2">@d('personal_111')</div>
    </div>
    <div class="office-page-reviews">
        <div class="office-page-reviews__content owl-carousel">

            @foreach($site->feedbacks as $feedback)
                <div class="office-page-reviews__review" data-name="{{ $feedback->name }}" data-text="{{ $feedback->text }}">
                    <div class="office-page-reviews__review-title">
                        {{ $feedback->name }}
                    </div>
                    <div>
                        {{ $feedback->text }}
                    </div>
                </div>
            @endforeach

        </div>
        <div class="office-page-reviews__add content">
            <div class="office-page-reviews__add-text">
                @d('personal_132')<br />
                @d('personal_133')
            </div>
            <a href="#" class="primary-button js-review-add-open">@d('personal_134')</a>
        </div>
    </div>

    <div class="screen-content" id="news">
        <div class="office-page__heading2">@d('personal_137')</div>
        <div class="news-list__content">
            @foreach($site->newsArticles as $newsArticle)
                @if($newsArticle->newsArticleTexts->isNotEmpty())
                <div class="news news-list__news js-news-item" data-id="{{ $newsArticle->id }}">
                    <a href="#"><img class="news__img" src="{{ Storage::disk('news_images')->url($newsArticle->preview)  }}" alt="{{ $newsArticle->newsArticleTexts->first()->header }}" /></a>
                    <div class="news__date">{{ $newsArticle->newsArticleTexts->first()->publication_date_text }}</div>
                    <a href="#" class="news__title">{{ $newsArticle->newsArticleTexts->first()->header }}</a>
                    <div class="news__desc">{{ $newsArticle->newsArticleTexts->first()->note }}</div>


                    <div class="news-modal js-news-modal">
                        <div class="news-modal__close"></div>
                        <div class="news-modal__img">
                            <picture>
                                <source srcset="{{ Storage::disk('news_images')->url($newsArticle->mobile) }}, {{ Storage::disk('news_images')->url($newsArticle->mobile2) }} 2x" media="(max-width: 480px)">
                                <source srcset="{{ Storage::disk('news_images')->url($newsArticle->image) }}, {{ Storage::disk('news_images')->url($newsArticle->image2) }} 2x">
                                <img class="news-modal__image" src="{{ Storage::disk('news_images')->url($newsArticle->image) }}" />
                            </picture>
                        </div>
                        <div class="news-modal__title-container">
                            <div class="news-modal__date">{{ $newsArticle->newsArticleTexts->first()->publication_date_text }}</div>
                            <div class="news-modal__title">{{ $newsArticle->newsArticleTexts->first()->header }}</div>
                        </div>
                        <div class="news-modal__text">
                            @php
                                $paragraphs = explode("\n", $newsArticle->newsArticleTexts->first()->text);
                            @endphp
                            @foreach($paragraphs as $paragraph)
                                <div class="news-modal__paragraph">{{ $paragraph }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="modal-container">
        @foreach($site->newsArticles as $newsArticle)
            @if($newsArticle->newsArticleTexts->isNotEmpty())
            <div class="news-modal js-news-modal" data-id="{{ $newsArticle->id }}">
                <div class="news-modal__close"></div>
                <div class="news-modal__img">
                    <picture>
                        <source srcset="{{ Storage::disk('news_images')->url($newsArticle->mobile) }}, {{ Storage::disk('news_images')->url($newsArticle->mobile2) }} 2x" media="(max-width: 480px)">
                        <source srcset="{{ Storage::disk('news_images')->url($newsArticle->image) }}, {{ Storage::disk('news_images')->url($newsArticle->image2) }} 2x">
                        <img class="news-modal__image" src="{{ Storage::disk('news_images')->url($newsArticle->image) }}" />
                    </picture>
                </div>
                <div class="news-modal__title-container">
                    <div class="news-modal__date">{{ $newsArticle->newsArticleTexts->first()->publication_date_text }}</div>
                    <div class="news-modal__title">{{ $newsArticle->newsArticleTexts->first()->header }}</div>
                </div>
                <div class="news-modal__text">
                    @php
                        $paragraphs = explode("\n", $newsArticle->newsArticleTexts->first()->text);
                    @endphp
                    @foreach($paragraphs as $paragraph)
                        <div class="news-modal__paragraph">{{ $paragraph }}</div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    </div>

    <div class="office-page-feedback" id="feedback">
        <div class="office-page-feedback__content">
            <div class="office-page-feedback__title js-result-hide">@d('personal_150')</div>
            <div class="office-page-feedback__text js-result-hide">@d('personal_151')<br />@d('personal_152')</div>
            <form method="post" action="{{ route('request.feedback') }}" class="office-page-feedback__form js-result-hide js-feedback-form">
                <div class="office-page-feedback__form-item">
                    <div class="office-page-feedback__form-item-left">
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="name" class="form-field__input" placeholder="{{ $dictionary['personal_feedback_name'] }}" />
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="email" class="form-field__input" placeholder="E-mail" />
                            </div>
                        </div>
                    </div>
                    <div class="office-page-feedback__form-item-right">
                        <div class="form__row">
                            <div class="form-field">
                                <textarea name="message" class="form-field__input office-page-feedback__textarea" placeholder="{{ $dictionary['personal_feedback_text'] }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="office-page-feedback__form-item office-page-feedback__form-item_centered">
                    <div class="office-page-feedback__form-item-left">
                        <div class="form-field">
                            <input type="submit" value="{{ $dictionary['personal_feedback_send'] }}" class="primary-button primary-button_wide primary-button_submit" />
                        </div>
                    </div>
                    <div class="office-page-feedback__form-item-right">
                        <div class="office-page-feedback__item-text">
                            @d('personal_153') <a class="office-page-feedback__link" href="#">@d('personal_154')</a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="office-page-feedback__result js-result-ok" style="display: none;">
                <div class="office-page-feedback__result-icon office-page-feedback__result-icon_ok"></div>
                <div class="office-page-feedback__result-title">@d('personal_155')<br />@d('personal_156')</div>
                <div class="office-page-feedback__result-text">@d('personal_157')</div>
            </div>
            <div class="office-page-feedback__result js-result-failed" style="display: none;">
                <div class="office-page-feedback__result-icon office-page-feedback__result-icon_error"></div>
                <div class="office-page-feedback__result-title">@d('personal_158')</div>
                <div class="office-page-feedback__result-text">@d('personal_159')</div>
            </div>
        </div>
    </div>
    <div class="office-page-logos">
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/ali-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/ali.svg">
                <img src="/personal/img-op/logo/ali.svg" />
            </picture>
        </div>
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/asos-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/asos.svg">
                <img src="/personal/img-op/logo/asos.svg" />
            </picture>
        </div>
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/avon-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/avon.svg">
                <img src="/personal/img-op/logo/avon.svg" />
            </picture>
        </div>
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/ebay-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/ebay.svg">
                <img src="/personal/img-op/logo/ebay.svg" />
            </picture>
        </div>
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/loreal-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/loreal.svg">
                <img src="/personal/img-op/logo/loreal.svg" />
            </picture>
        </div>
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/marykay-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/marykay.svg">
                <img src="/personal/img-op/logo/marykay.svg" />
            </picture>
        </div>
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/oriflame-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/oriflame.svg">
                <img src="/personal/img-op/logo/oriflame.svg" />
            </picture>
        </div>
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/ozon-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/ozon.svg">
                <img src="/personal/img-op/logo/ozon.svg" />
            </picture>
        </div>
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/rebound-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/rebound.svg">
                <img src="/personal/img-op/logo/rebound.svg" />
            </picture>
        </div>
        <div class="office-page-logos__item">
            <picture>
                <source srcset="/personal/img-op/logo/yvesrocher-mobile.svg" media="(max-width: 1199px)">
                <source srcset="/personal/img-op/logo/yvesrocher.svg">
                <img src="/personal/img-op/logo/yvesrocher.svg" />
            </picture>
        </div>
    </div>

        <footer class="footer-new">
            <div class="footer-new__content">
                <div class="footer-new__left">
                    <a class="footer-logo footer-new__logo" href="#"></a>
                    <div>
                        <div class="footer-new__links">
                            <div class="footer-new__links-item">
                                <a href="#" class="footer-new__link footer-new__link_bold">@d('personal_160')</a>
                            </div>
                            <div class="footer-new__links-item">
                                <a href="#" class="footer-new__link footer-new__link_bold">@d('personal_161')</a>
                            </div>
                        </div>
                        <div class="footer-new__links footer-new__links_last">
                            <div class="footer-new__links-item">
                                @d('personal_162')
                            </div>
                            <div class="footer-new__links-item">
                                <a href="#" class="footer-new__link">@d('personal_163')</a>
                            </div>
                        </div>
                        <a href="https://cdek.ru" target="_blank" class="footer-new__link footer-new__link_bold">@d('personal_164')</a>
                    </div>
                </div>
                <div class="footer-new__right">
                    <div class="footer-new__text">
                        @d('personal_165')<br />
                        @d('personal_166')<br />
                        @d('personal_167')
                    </div>
                    <div>

                        @foreach($site->localOffices as $localOffice)
                            @foreach($localOffice->localOfficePhones as $localOfficePhone)
                                <div class="footer-new__phone">{{$localOfficePhone->phone_text}}</div>
                            @endforeach
                                @foreach($localOffice->localOfficeEmails as $localOfficeEmail)
                                    <a href="mailto:{{ $localOfficeEmail->email }}" class="footer-new__link footer-email">{{ $localOfficeEmail->email }}</a>
                                @endforeach
                        @endforeach

                    </div>
                </div>
            </div>
        </footer>




        <div class="modal-container">
            <div class="modal" id="feedback-modal">
                <div class="modal__close"></div>
                <div class="modal__content">
                    <div class="modal__heading">@d('personal_170')</div>
                    <div class="form calculator_form">
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="name" class="form-field__input" placeholder="Имя" />
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="phone" class="form-field__input" placeholder="Телефон" />
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="email" class="form-field__input" placeholder="E-mail" />
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <textarea name="message" class="form-field__input" placeholder="Текст вопроса"></textarea>
                            </div>
                        </div>
                        <div class="form__row form__row_no-input">
                            <div class="checkbox-widget">
                                <input type="checkbox" name="agree" id="modal-agree" /><label for="modal-agree"><span>@d('personal_171') <a class="checkbox-widget__link" href="#">@d('personal_172')</a></span></label>
                            </div>
                        </div>
                        <div class="form-field">
                            <input type="submit" value="Отправить" class="primary-button primary-button_wide primary-button_submit" />
                        </div>
                    </div>
                </div>
                <div class="modal__content modal__content_result js-modal-result-ok" style="display: none;">
                    <div>
                        <div class="modal__result-icon modal__result-icon_ok"></div>
                        <div class="modal__result-title">@d('personal_173')<br />@d('personal_174')</div>
                        <div class="modal__result-text">@d('personal_175')</div>
                    </div>
                </div>
                <div class="modal__content modal__content_result js-modal-result-error" style="display: none;">
                    <div>
                        <div class="modal__result-icon modal__result-icon_error"></div>
                        <div class="modal__result-title">@d('personal_176')</div>
                        <div class="modal__result-text">@d('personal_177')</div>
                    </div>
                </div>
            </div>

            <div id="review-modal" class="review-modal">
                <div class="review-modal__close"></div>
                <div class="review-modal__title">@d('personal_182')</div>
                <div class="review-modal__text">
                    @d('personal_183')
                    @d('personal_183')
                </div>
            </div>


            <div id="presentation-modal" class="presentation-modal">
                <div class="presentation-modal__close"></div>
                <form method="post" action="{{ route('request.presentation') }}" class="presentation-modal__form js-presentation-form">
                    <div class="presentation-modal__bg"></div>
                    <div class="presentation-modal__title">@d('personal_184')</div>
                    <div class="form calculator_form">
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="name" class="form-field__input" placeholder="{{ $dictionary['personal_presentation_form_name'] }}" />
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="phone" class="form-field__input" placeholder="{{ $dictionary['personal_presentation_form_phone'] }}" />
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="email" class="form-field__input" placeholder="{{ $dictionary['personal_presentation_form_email'] }}" />
                            </div>
                        </div>
                        <div class="form__row form__row_no-input">
                            <div class="checkbox-widget">
                                <input type="checkbox" name="agree" value="1" id="modal-agree2" required /><label for="modal-agree2"><span>@d('personal_185') <a class="checkbox-widget__link" href="#">@d('personal_186')</a></span></label>
                            </div>
                        </div>
                        <div class="form-field">
                            <input type="submit" value="{{ $dictionary['personal_presentation_form_submit'] }}" class="primary-button primary-button_wide primary-button_submit" />
                        </div>
                    </div>
                </form>
                <div class="presentation-modal__result js-modal-result-ok" style="display: none;">
                    <div>
                        <div class="presentation-modal__result-icon presentation-modal__result-icon_ok"></div>
                        <div class="presentation-modal__result-title">@d('personal_187')</div>
                        <div class="presentation-modal__result-text">@d('personal_188')</div>
                        <a href="/request/images/presentation.pptx" class="presentation-modal__download">@d('personal_189')</a>
                    </div>
                </div>
                <div class="presentation-modal__result js-modal-result-error" style="display: none;">
                    <div>
                        <div class="presentation-modal__result-icon presentation-modal__result-icon_error"></div>
                        <div class="presentation-modal__result-title">@d('personal_190')</div>
                        <div class="presentation-modal__result-text">@d('personal_191')</div>
                    </div>
                </div>
            </div>

            <div id="review-add-modal" class="review-add-modal">
                <div class="review-add-modal__close"></div>
                <div class="review-add-modal__content js-modal-result-hide">
                    <div class="review-add-modal__title">Добавить отзыв</div>
                    <form method="post" action="{!! route('request.feedback_review') !!}" class="form calculator_form js-feedback-review-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="language_id" value="{{ $language->id }}">
                        <div class="review-add-modal__two-fields">
                            <div class="form__row review-add-modal__two-fields-item">
                                <div class="form-field">
                                    <input type="text" name="name" class="form-field__input js-feedback-review-name" placeholder="Ваше имя" />
                                    <div class="form-field__error-message">Поле обязательно для заполнения</div>
                                </div>
                            </div>
                            <div class="form__row review-add-modal__two-fields-item">
                                <div class="form-field">
                                    <input type="text" name="email" class="form-field__input js-feedback-review-email" placeholder="E-mail" />
                                </div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <textarea name="text" class="form-field__input js-feedback-review-text" placeholder="Текст отзыва"></textarea>
                            </div>
                        </div>
                        <div class="form__row form__row_no-input">
                            <div class="checkbox-widget">
                                <input type="checkbox" name="agree" id="modal-agree_review" class="js-feedback-review-checkbox" /><label for="modal-agree_review"><span>Я соглашаюсь с <a class="checkbox-widget__link" href="#">условиями обработки персональных данных</a></span></label>
                            </div>
                        </div>
                        <div class="form-field">
                            <input type="submit" value="Отправить" class="primary-button primary-button_wide primary-button_submit" />
                        </div>
                    </form>
                </div>
                <div class="review-add-modal__result js-modal-result-ok" style="display: none;">
                    <div>
                        <div class="review-add-modal__result-icon review-add-modal__result-icon_ok"></div>
                        <div class="review-add-modal__result-title">Сообщение<br />успешно отправлено!</div>
                        <div class="review-add-modal__result-text">Постаремся ответить на ваш запрос, как можно скорее.</div>
                    </div>
                </div>
                <div class="review-add-modal__result js-modal-result-error" style="display: none;">
                    <div>
                        <div class="review-add-modal__result-icon review-add-modal__result-icon_error"></div>
                        <div class="review-add-modal__result-title">Сообщение не отправлено!</div>
                        <div class="review-add-modal__result-text">Что-то пошло не так, попробуйте отправить еще раз позднее.</div>
                    </div>
                </div>
            </div>

        </div>

        @include('site.universal2.allow_cookies')
    </div>

    <script id="recaptcha_script" data-key="{{ config('app.recapcha3_key') }}" src="https://www.google.com/recaptcha/api.js?render={{ config('app.recapcha3_key') }}"  async defer></script>
    <script src="{{ mix('personal/new.js') }}" defer></script>
    </body>
</html>
