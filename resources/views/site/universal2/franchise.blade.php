@extends('site.universal2.layout')

@section('content')

    <div class="franchise-page">
        <div class="main-poster franchise-page__poster screen">
            <div class="main-poster__content">
                <div class="main-poster__heading franchise-page__poster-heading">
                    <h1 class="typo-h1 franchise-page__typo-h1">
                        @d('franchise_11')
                    </h1>
                </div>
                <div class="main-poster__text franchise-page__poster-text">
                    @d('franchise_12') <br />
                    @d('franchise_13')
                </div>
                <a href="#join" class="primary-button primary-button_with_arrow franchise-page__primary-button gtm-click" data-click="join_franchise_start" >@d('franchise_14')</a>
                <div class="background-dots main-poster__dots-left"></div>
                <div class="main-poster__wave-right"></div>
            </div>
            <picture class="index-page__poster-image-wrapper franchise-page__poster-image-wrapper">
                <source srcset="/universal2/img/franchise/poster-mobile.jpg, /universal2/img/franchise/poster-mobile-2x.jpg 2x">
                <img src="/universal2/img/franchise/poster-mobile.jpg" alt="" class="index-page__poster-image">
            </picture>
        </div>
        <div class="franchise-world screen-content">
            <h2 class="typo-h2 franchise-page__typo-h2 franchise-world__typo-h2">
                @d('franchise_15')
                <span class="typo-colored typo-colored_color_green">@d('franchise_16')</span>
            </h2>
            <div class="franchise-world__content">
                <div class="franchise-world__content-text">
                    <div class="circle-icon circle-icon_icon_earth circle-icon-list__icon franchise-world__circle-icon"></div>
                    <div class="franchise-world__title">@d('franchise_17')</div>
                    <div class="franchise-world__text">
                        @d('franchise_18') <br />
                        @d('franchise_19')
                    </div>
                </div>
                <picture class="franchise-world__image-wrapper">
                    <source media="(max-width: 480px)" srcset="/universal2/img/franchise/franchise-world-mobile.jpg, /universal2/img/franchise/franchise-world-mobile-2x.jpg 2x">
                    <source media="(min-width: 481px) and (max-width: 1199px)" srcset="/universal2/img/franchise/franchise-world-tablet.jpg, /universal2/img/franchise/franchise-world-tablet-2x.jpg 2x">
                    <source media="(min-width: 1200px)" srcset="/universal2/img/franchise/franchise-world.jpg, /universal2/img/franchise/franchise-world-2x.jpg 2x">
                    <img src="/universal2/img/franchise/franchise-world.jpg" alt="" class="franchise-world__image">
                </picture>
            </div>
        </div>
        <div class="company-advantages screen franchise-company-advantages">
            <div class="content">
                <h2 class="typo-h2 franchise-page__typo-h2">@d('franchise_20')</h2>
                <div class="square-cards js-company-advantages owl-carousel">
                    <div class="square-card square-card_big-icon_routes square-card_size_big square-card_franchise">
                        <div class="square-card__bg"></div>
                        <div class="square-card__title">@d('franchise_21')</div>
                    </div>
                    <div class="square-card square-card_big-icon_training square-card_size_big square-card_franchise">
                        <div class="square-card__bg"></div>
                        <div class="square-card__title">@d('franchise_22')</div>
                    </div>
                    <div class="square-card square-card_big-icon_promotion square-card_size_big square-card_franchise">
                        <div class="square-card__bg"></div>
                        <div class="square-card__title">@d('franchise_23')</div>
                    </div>
                    <div class="square-card square-card_icon_settings square-card_size_big square-card_franchise">
                        <div class="square-card__bg"></div>
                        <div class="square-card__title">@d('franchise_24') <br /> @d('franchise_25')</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="franchise-earnings screen-content franchise-page__franchise-earnings">
            <h2 class="typo-h2 franchise-page__typo-h2">@d('franchise_26')</h2>
            <div class="franchise-earnings__item franchise-earnings__item_left">
                <div class="franchise-earnings__item-text-content">
                    <div class="franchise-earnings__item-title">@d('franchise_27')</div>
                    <p class="franchise-earnings__item-text">@d('franchise_28')</p>
                    <p class="franchise-earnings__item-text">@d('franchise_29')</p>
                </div>
                <picture class="franchise-earnings__image-wrapper">
                    <source media="(max-width: 480px)" srcset="/universal2/img/franchise/earnings-i1-mobile.jpg, /universal2/img/franchise/earnings-i1-mobile-2x.jpg 2x">
                    <source media="(min-width: 481px) and (max-width: 1199px)" srcset="/universal2/img/franchise/earnings-i1-tablet.jpg, /universal2/img/franchise/earnings-i1-tablet-2x.jpg 2x">
                    <source media="(min-width: 1200px)" srcset="/universal2/img/franchise/earnings-i1.jpg, /universal2/img/franchise/earnings-i1-2x.jpg 2x">
                    <img src="/universal2/img/franchise/earnings-i1.jpg" alt="" class="franchise-earnings__image">
                </picture>
            </div>
            <div class="franchise-earnings__item">
                <picture class="franchise-earnings__image-wrapper">
                    <source media="(max-width: 480px)" srcset="/universal2/img/franchise/earnings-i2-mobile.jpg, /universal2/img/franchise/earnings-i2-mobile-2x.jpg 2x">
                    <source media="(min-width: 481px) and (max-width: 1199px)" srcset="/universal2/img/franchise/earnings-i2-tablet.jpg, /universal2/img/franchise/earnings-i2-tablet-2x.jpg 2x">
                    <source media="(min-width: 1200px)" srcset="/universal2/img/franchise/earnings-i2.jpg, /universal2/img/franchise/earnings-i2-2x.jpg 2x">
                    <img src="/universal2/img/franchise/earnings-i2.jpg" alt="" class="franchise-earnings__image">
                </picture>
                <div class="franchise-earnings__item-text-content">
                    <div class="franchise-earnings__item-title">@d('franchise_30')</div>
                    <p class="franchise-earnings__item-text franchise-earnings__item-text_bold">@d('franchise_31')</p>
                    <p class="franchise-earnings__item-text">@d('franchise_32')</p>
                    <p class="franchise-earnings__item-text franchise-earnings__item-text_bold">@d('franchise_33')</p>
                    <p class="franchise-earnings__item-text">@d('franchise_34')</p>
                </div>
            </div>
        </div>
        <div class="franchise-presentation screen-content franchise-page__franchise-presentation">
            <div class="franchise-presentation__content">
                <div class="franchise-presentation__title">
                    @d('franchise_35') <br />
                    @d('franchise_36')
                </div>
                <a href="#join" class="primary-button franchise-presentation__primary-button gtm-click" data-click="join_franchise_presentation">@d('franchise_37')</a>
            </div>
        </div>
        <div class="franchise-format screen">
            <div class="franchise-format__content">
                <div class="content">
                    <h2 class="typo-h2 franchise-format__typo-h2">
                        @d('franchise_38') <br />
                        @d('franchise_39')
                    </h2>
                    <div class="submenu submenu_centered franchise-format__submenu">
                        <div class="submenu__content">
                            <a href="#" class="submenu__item submenu__item_active js-franchise-format-handler" data-format="pvz">@d('franchise_40')</a>
                            <a href="#" class="submenu__item js-franchise-format-handler" data-format="shop">@d('franchise_41')</a>
                        </div>
                    </div>
                    <div class="franchise-format__item js-franchise-format" data-format="pvz">
                        <div class="franchise-format__item-text-content">
                            <div class="franchise-format__item-title">@d('franchise_42')</div>
                            <div class="franchise-format__item-text">@d('franchise_43')</div>
                            <ul class="franchise-format__list">
                                <li class="franchise-format__list-item">@d('franchise_44')</li>
                                <li class="franchise-format__list-item">@d('franchise_45')</li>
                                <li class="franchise-format__list-item">@d('franchise_46')</li>
                            </ul>
                            <div class="franchise-format__tariff">
                                <div class="franchise-format__tariff-item">
                                    <div class="franchise-format__tariff-icon franchise-format__tariff-icon_contribution"></div>
                                    <div class="franchise-format__tariff-value">@d('franchise_47')</div>
                                    <div class="franchise-format__tariff-text">@d('franchise_48')</div>
                                </div>
                                <div class="franchise-format__tariff-item">
                                    <div class="franchise-format__tariff-icon franchise-format__tariff-icon_without-royalties"></div>
                                    <div class="franchise-format__tariff-value">@d('franchise_49')</div>
                                    <div class="franchise-format__tariff-text">@d('franchise_50')</div>
                                </div>
                                <div class="franchise-format__tariff-item">
                                    <div class="franchise-format__tariff-icon franchise-format__tariff-icon_royalties"></div>
                                    <div class="franchise-format__tariff-value">@d('franchise_51')</div>
                                    <div class="franchise-format__tariff-text">@d('franchise_52')</div>
                                </div>
                            </div>
                        </div>
                        <picture class="franchise-format__image-wrapper">
                            <source media="(max-width: 480px)" srcset="/universal2/img/franchise/format-mobile.png, /universal2/img/franchise/format-mobile-2x.png 2x">
                            <source media="(min-width: 481px) and (max-width: 1199px)" srcset="/universal2/img/franchise/format-tablet.png, /universal2/img/franchise/format-tablet-2x.png 2x">
                            <source media="(min-width: 1200px)" srcset="/universal2/img/franchise/format.png, /universal2/img/franchise/format-2x.png 2x">
                            <img src="/universal2/img/franchise/format.png" alt="" class="franchise-format__image">
                        </picture>
                    </div>
                    <div class="franchise-format__item js-franchise-format hidden" data-format="shop">
                        <div class="franchise-format__item-text-content">
                            <div class="franchise-format__item-title">@d('franchise_53')</div>
                            <div class="franchise-format__item-text">@d('franchise_54')</div>
                            <ul class="franchise-format__list">
                                <li class="franchise-format__list-item">@d('franchise_55')</li>
                                <li class="franchise-format__list-item">@d('franchise_56')</li>
                                <li class="franchise-format__list-item">@d('franchise_57')</li>
                            </ul>
                            <div class="franchise-format__tariff">
                                <div class="franchise-format__tariff-item">
                                    <div class="franchise-format__tariff-icon franchise-format__tariff-icon_contribution"></div>
                                    <div class="franchise-format__tariff-value">@d('franchise_58')</div>
                                    <div class="franchise-format__tariff-text">@d('franchise_59')</div>
                                </div>
                                <div class="franchise-format__tariff-item">
                                    <div class="franchise-format__tariff-icon franchise-format__tariff-icon_nooffice"></div>
                                    <div class="franchise-format__tariff-value">@d('franchise_60')</div>
                                    <div class="franchise-format__tariff-text">@d('franchise_61')</div>
                                </div>
                                <div class="franchise-format__tariff-item">
                                    <div class="franchise-format__tariff-icon franchise-format__tariff-icon_royalties"></div>
                                    <div class="franchise-format__tariff-value">@d('franchise_62')</div>
                                    <div class="franchise-format__tariff-text">@d('franchise_63')</div>
                                </div>
                            </div>
                        </div>
                        <picture class="franchise-format__image-wrapper">
                            <source media="(max-width: 480px)" srcset="/universal2/img/franchise/format-mobile.png, /universal2/img/franchise/format-mobile-2x.png 2x">
                            <source media="(min-width: 481px) and (max-width: 1199px)" srcset="/universal2/img/franchise/format-tablet.png, /universal2/img/franchise/format-tablet-2x.png 2x">
                            <source media="(min-width: 1200px)" srcset="/universal2/img/franchise/format.png, /universal2/img/franchise/format-2x.png 2x">
                            <img src="/universal2/img/franchise/format.png" alt="" class="franchise-format__image">
                        </picture>
                    </div>
                </div>
            </div>
            <div class="franchise-format__content-bg"></div>
        </div>
        <div class="franchise-start-a-business screen">
            <h2 class="typo-h2 franchise-start-a-business__typo-h2">@d('franchise_64')</h2>
            <div class="content">
                <div class="franchise-start-a-business__content ">
                    <div class="franchise-start-a-business__item">
                        <div class="franchise-start-a-business__item-icon-container">
                            <div class="franchise-start-a-business__item-icon franchise-start-a-business__item-icon_img-i1"></div>
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_desktop">@d('franchise_65')</div>
                        </div>
                        <div class="franchise-start-a-business__item-text-content">
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_mobile">@d('franchise_66')</div>
                            <div class="franchise-start-a-business__item-text">
                                <span class="franchise-start-a-business__item-text_bold">@d('franchise_67')</span>
                                @d('franchise_68') <br /> @d('franchise_69')
                            </div>
                        </div>
                    </div>
                    <div class="franchise-start-a-business__item">
                        <div class="franchise-start-a-business__item-icon-container">
                            <div class="franchise-start-a-business__item-icon franchise-start-a-business__item-icon_img-i2"></div>
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_desktop">@d('franchise_70')</div>
                        </div>
                        <div class="franchise-start-a-business__item-text-content">
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_mobile">@d('franchise_71')</div>
                            <div class="franchise-start-a-business__item-text">
                                <span class="franchise-start-a-business__item-text_bold">@d('franchise_72')</span>
                                 @d('franchise_73')
                            </div>
                        </div>
                    </div>
                    <div class="franchise-start-a-business__item">
                        <div class="franchise-start-a-business__item-icon-container">
                            <div class="franchise-start-a-business__item-icon franchise-start-a-business__item-icon_img-i3"></div>
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_desktop">@d('franchise_74')</div>
                        </div>
                        <div class="franchise-start-a-business__item-text-content">
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_mobile">@d('franchise_75')</div>
                            <div class="franchise-start-a-business__item-text">
                                <span class="franchise-start-a-business__item-text_bold">@d('franchise_76')</span>
                                @d('franchise_77')
                                @d('franchise_77')
                            </div>
                        </div>
                    </div>
                    <div class="franchise-start-a-business__item">
                        <div class="franchise-start-a-business__item-icon-container">
                            <div class="franchise-start-a-business__item-icon franchise-start-a-business__item-icon_img-i4"></div>
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_desktop">@d('franchise_78')</div>
                        </div>
                        <div class="franchise-start-a-business__item-text-content">
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_mobile">@d('franchise_79')</div>
                            <div class="franchise-start-a-business__item-text">
                                <span class="franchise-start-a-business__item-text_bold">@d('franchise_80')</span>
                                @d('franchise_81') <br />
                                @d('franchise_82')
                            </div>
                        </div>
                    </div>
                    <div class="franchise-start-a-business__item">
                        <div class="franchise-start-a-business__item-icon-container">
                            <div class="franchise-start-a-business__item-icon franchise-start-a-business__item-icon_img-i5"></div>
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_desktop">@d('franchise_83')</div>
                        </div>
                        <div class="franchise-start-a-business__item-text-content">
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_mobile">@d('franchise_84')</div>
                            <div class="franchise-start-a-business__item-text">
                                <span class="franchise-start-a-business__item-text_bold">@d('franchise_85')</span>
                                @d('franchise_86') <br /> @d('franchise_87') <br /> @d('franchise_88')
                            </div>
                        </div>
                    </div>
                    <div class="franchise-start-a-business__item">
                        <div class="franchise-start-a-business__item-icon-container">
                            <div class="franchise-start-a-business__item-icon franchise-start-a-business__item-icon_img-i6"></div>
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_desktop">@d('franchise_89')</div>
                        </div>
                        <div class="franchise-start-a-business__item-text-content">
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_mobile">@d('franchise_90')</div>
                            <div class="franchise-start-a-business__item-text">
                                <span class="franchise-start-a-business__item-text_bold">@d('franchise_91')</span>
                                @d('franchise_92') <br /> @d('franchise_93') <br /> @d('franchise_94')
                            </div>
                        </div>
                    </div>
                    <div class="franchise-start-a-business__item">
                        <div class="franchise-start-a-business__item-icon-container">
                            <div class="franchise-start-a-business__item-icon franchise-start-a-business__item-icon_img-i7"></div>
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_desktop">@d('franchise_95')</div>
                        </div>
                        <div class="franchise-start-a-business__item-text-content">
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_mobile">@d('franchise_96')</div>
                            <div class="franchise-start-a-business__item-text">
                                <span class="franchise-start-a-business__item-text_bold">@d('franchise_97')</span>
                                @d('franchise_98') <br /> @d('franchise_99')
                            </div>
                        </div>
                    </div>
                    <div class="franchise-start-a-business__item">
                        <div class="franchise-start-a-business__item-icon-container">
                            <div class="franchise-start-a-business__item-icon franchise-start-a-business__item-icon_img-i8"></div>
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_desktop">@d('franchise_100')</div>
                        </div>
                        <div class="franchise-start-a-business__item-text-content">
                            <div class="franchise-start-a-business__item-num franchise-start-a-business__item-num_mobile">@d('franchise_101')</div>
                            <div class="franchise-start-a-business__item-text">
                                <span class="franchise-start-a-business__item-text_bold">@d('franchise_102')</span>
                                @d('franchise_103') <br />
                                @d('franchise_104')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="franchise-form" id="join">
            <div class="content">
                <div class="franchise-form__content">
                    <div class="franchise-form__form-title">
                        @d('franchise_105') <br/>
                        @d('franchise_106')
                    </div>
                    <div class="franchise-form__form-text">@d('franchise_107')</div>
                    <div class="franchise-form__form form-order-docs form-order-docs_feedback js-franchise-form-wrapper preloader">
                        <form method="post" action="{{ route('request.franchise') }}" class="form js-franchise-form" data-send-form-event="send_franchise" data-send-form-success-event="send_success_franchise">
                            <input type="hidden" name="url" value="{{ $url->full() }}">
                            <div class="form__row">
                                <div class="form-field">
                                    <input type="text" name="name" class="form-field__input franchise-focus-reset-error" placeholder="{{ $dictionary['franchise_form_name'] }}" />
                                </div>
                            </div>
                            <div class="form__row">
                                <div class="form-field">
                                    <input type="text" name="phone" class="form-field__input franchise-focus-reset-error" placeholder="{{ $dictionary['franchise_form_phone'] }}" />
                                </div>
                            </div>
                            <div class="form__row">
                                <div class="form-field">
                                    <input type="text" name="whatsapp" class="form-field__input franchise-focus-reset-error" placeholder="{{ $dictionary['franchise_form_whatsapp'] }}" />
                                </div>
                            </div>
                            <div class="form__row">
                                <div class="form-field">
                                    <input type="text" name="email" class="form-field__input franchise-focus-reset-error" placeholder="{{ $dictionary['franchise_form_email'] }}" />
                                </div>
                            </div>
                            <div class="form__row">
                                <div class="form-field">
                                    <input type="text" name="city" class="form-field__input franchise-focus-reset-error" placeholder="{{ $dictionary['franchise_form_city'] }}" />
                                </div>
                            </div>
                            <div class="form__row form__row_no-input">
                                <div class="checkbox-widget">
                                    <input type="checkbox" name="agree" id="modal-agree" class="franchise-focus-reset-error" /><label for="modal-agree"><span>@d('franchise_108') <a class="checkbox-widget__link" href="#">@d('franchise_109')</a></span></label>
                                    <div class="form-field__error-message">@d('franchise_form_required')</div>
                                </div>
                            </div>
                            <div class="form-field">
                                <input type="submit" value="{{ $dictionary['franchise_form_submit'] }}" class="primary-button primary-button_wide primary-button_submit" />
                            </div>
                        </form>
                        <div class="form-order-docs__result js-franchise-success" style="display: none;">
                            <div class="form-order-docs__result-icon form-order-docs__result-icon_ok"></div>
                            <div class="form-order-docs__result-title">
                                @d('franchise_110') <br />
                                @d('franchise_111')
                            </div>
                            <div class="form-order-docs__result-text form-order-docs__result-text_small-bottom">@d('franchise_112') <br />
                                @d('franchise_113')</div>
                            <a href="#" class="alternative-button js-franchise-new-answer">@d('franchise_114')</a>
                        </div>

                        <div class="form-order-docs__result hidden js-franchise-error"  style="display: none;">
                            <div class="form-order-docs__result-icon form-order-docs__result-icon_error"></div>
                            <div class="form-order-docs__result-title">
                                @d('franchise_115')
                            </div>
                            <div class="form-order-docs__result-text form-order-docs__result-text_small-bottom">
                                @d('franchise_116') <br />
                                @d('franchise_117')
                            </div>
                            <a href="#" class="alternative-button js-franchise-retry">@d('franchise_118')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

