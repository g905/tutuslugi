@extends('layouts.app')

@section('content')
    <div class="container">
        @include("user.menu")
        <div class="page-col-inner">



            <div class="page-col-left s-895">


                <div class="user-cabinet-section">

                    <section class="user-profile">
                        <div class="user-profile__image">
                            @if(Auth::user()->photo)
                                <img src=" {{ asset("storage".Auth::user()->photo) }}"/>
                            @else
                            <img src="/images/user-avatar-default.png"/>
                            @endif
                            <form method="post" action="{{route('user.upload.photo')}}" id="user-upload-photo">
                                <label>
                                    <i>
                                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="0.5" y="0.5" width="35" height="35" rx="11.5" fill="white"/>
                                            <path d="M13.6892 13.1458C13.5392 13.3833 13.339 13.585 13.1028 13.7369C12.8665 13.8887 12.5999 13.9871 12.3217 14.025C12.005 14.07 11.6908 14.1183 11.3767 14.1708C10.4992 14.3167 9.875 15.0892 9.875 15.9783V23C9.875 23.4973 10.0725 23.9742 10.4242 24.3258C10.7758 24.6775 11.2527 24.875 11.75 24.875H24.25C24.7473 24.875 25.2242 24.6775 25.5758 24.3258C25.9275 23.9742 26.125 23.4973 26.125 23V15.9783C26.125 15.0892 25.5 14.3167 24.6233 14.1708C24.3089 14.1185 23.9939 14.0698 23.6783 14.025C23.4002 13.987 23.1338 13.8886 22.8977 13.7367C22.6616 13.5848 22.4616 13.3832 22.3117 13.1458L21.6267 12.0492C21.4728 11.7993 21.261 11.5901 21.0092 11.4394C20.7574 11.2887 20.473 11.2008 20.18 11.1833C18.7277 11.1053 17.2723 11.1053 15.82 11.1833C15.527 11.2008 15.2426 11.2887 14.9908 11.4394C14.739 11.5901 14.5272 11.7993 14.3733 12.0492L13.6892 13.1458V13.1458Z" stroke="#7D2AEB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21.75 18.625C21.75 19.6196 21.3549 20.5734 20.6516 21.2766C19.9484 21.9799 18.9946 22.375 18 22.375C17.0054 22.375 16.0516 21.9799 15.3483 21.2766C14.6451 20.5734 14.25 19.6196 14.25 18.625C14.25 17.6304 14.6451 16.6766 15.3483 15.9733C16.0516 15.2701 17.0054 14.875 18 14.875C18.9946 14.875 19.9484 15.2701 20.6516 15.9733C21.3549 16.6766 21.75 17.6304 21.75 18.625V18.625ZM23.625 16.75H23.6317V16.7567H23.625V16.75Z" stroke="#7D2AEB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <rect x="0.5" y="0.5" width="35" height="35" rx="11.5" stroke="#7D2AEB"/>
                                        </svg>

                                    </i>
                                    <input accept="image/png, image/jpg, image/jpeg" type="file"/>
                                </label>
                            </form>
                        </div>

                        <div class="user-profile__info">
                            <div class="user-profile__info-section-title d-flex align-content-center align-items-center">{{Auth::user()->name}} <a href="{{route('user.profile.settings')}}" class="edit-profile-block"><i><svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.69478 11.3369L0.432779 13.8776C0.396408 13.9508 0.387505 14.031 0.407172 14.1082C0.426839 14.1854 0.474213 14.2563 0.543419 14.3121C0.612626 14.3678 0.700622 14.406 0.796498 14.4218C0.892375 14.4377 0.991915 14.4305 1.08278 14.4012L4.23778 13.3846C4.74075 13.2226 5.19765 12.9801 5.58078 12.6717L16.4998 3.875C16.8976 3.55453 17.1211 3.11988 17.1211 2.66667C17.1211 2.21345 16.8976 1.7788 16.4998 1.45833C16.102 1.13786 15.5624 0.957825 14.9998 0.957825C14.4372 0.957825 13.8976 1.13786 13.4998 1.45833L2.57978 10.255C2.19689 10.5636 1.89581 10.9317 1.69478 11.3369V11.3369Z" fill="#7D2AEB"/>
                                        </svg>
                                    </i></a></div>
                            <div class="user-profile__info-phone">+{{Auth::user()->phone}}</div>
                            <div class="user-profile__info-stats">
                                <button type="button"><i><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.25C4.615 0.25 0.25 4.615 0.25 10C0.25 15.385 4.615 19.75 10 19.75C15.385 19.75 19.75 15.385 19.75 10C19.75 4.615 15.385 0.25 10 0.25ZM10.53 5.72C10.3894 5.57955 10.1988 5.50066 10 5.50066C9.80125 5.50066 9.61063 5.57955 9.47 5.72L6.47 8.72C6.39631 8.78866 6.33721 8.87146 6.29622 8.96346C6.25523 9.05546 6.23318 9.15477 6.23141 9.25548C6.22963 9.35618 6.24816 9.45621 6.28588 9.5496C6.3236 9.64299 6.37974 9.72782 6.45096 9.79904C6.52218 9.87026 6.60701 9.9264 6.7004 9.96412C6.79379 10.0018 6.89382 10.0204 6.99452 10.0186C7.09522 10.0168 7.19454 9.99477 7.28654 9.95378C7.37854 9.91279 7.46134 9.85369 7.53 9.78L9.25 8.06V13.75C9.25 13.9489 9.32902 14.1397 9.46967 14.2803C9.61032 14.421 9.80109 14.5 10 14.5C10.1989 14.5 10.3897 14.421 10.5303 14.2803C10.671 14.1397 10.75 13.9489 10.75 13.75V8.06L12.47 9.78C12.5387 9.85369 12.6215 9.91279 12.7135 9.95378C12.8055 9.99477 12.9048 10.0168 13.0055 10.0186C13.1062 10.0204 13.2062 10.0018 13.2996 9.96412C13.393 9.9264 13.4778 9.87026 13.549 9.79904C13.6203 9.72782 13.6764 9.64299 13.7141 9.5496C13.7518 9.45621 13.7704 9.35618 13.7686 9.25548C13.7668 9.15477 13.7448 9.05546 13.7038 8.96346C13.6628 8.87146 13.6037 8.78866 13.53 8.72L10.53 5.72Z" fill="white"/>
                                        </svg>
                                    </i>Поднять бесплатно</button>
                                <span class="stat-view">Просмотры профиля: {{Auth::user()->views_total}} (сегодня {{Auth::user()->views_today}})</span>
                            </div>
                            <div class="user-profile__info-stats-text">
                                Один раз в день вы можете бесплатно поднять свой профиль. Это сделает ваше предложение заметнее и выделит среди конкурентов.
                            </div>
                        </div>

                    </section>


                    <section class="user-text-default">
                            <div class="user-profile__info-section-title d-flex align-content-center align-items-center">О себе <a href="#" class="edit-profile-block edit-profile-base-info"><i><svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.69478 11.3369L0.432779 13.8776C0.396408 13.9508 0.387505 14.031 0.407172 14.1082C0.426839 14.1854 0.474213 14.2563 0.543419 14.3121C0.612626 14.3678 0.700622 14.406 0.796498 14.4218C0.892375 14.4377 0.991915 14.4305 1.08278 14.4012L4.23778 13.3846C4.74075 13.2226 5.19765 12.9801 5.58078 12.6717L16.4998 3.875C16.8976 3.55453 17.1211 3.11988 17.1211 2.66667C17.1211 2.21345 16.8976 1.7788 16.4998 1.45833C16.102 1.13786 15.5624 0.957825 14.9998 0.957825C14.4372 0.957825 13.8976 1.13786 13.4998 1.45833L2.57978 10.255C2.19689 10.5636 1.89581 10.9317 1.69478 11.3369V11.3369Z" fill="#7D2AEB"/>
                                        </svg>
                                    </i></a>
                            </div>

                        <div class="text-info-empty">
                            Расскажите подробно о себе: про ваш опыт, навыки и преимущества, как давно работаете,<br/> что умеете. Это поможет клиентам лучше узнать вас.
                        </div>
                        <div class="profile-edit-base-info d-none">
                            <form method="POST" action="{{ route('user.about') }}/" name="form-user-about">
                                @csrf
                                <div class="form-ui-style-default">


                                    <div class="form-group small-form-group">
                                        <label for="name">Стаж работы в годах</label>

                                        <div>
                                            <input maxlength="2" id="work_experience" type="number" class="form-control " name="work_experience" value="{{Auth::user()->work_experience}}" >
                                        </div>
                                    </div>


                                    <div class="form-group">

                                        <label for="email">Расскажите о себе</label>


                                        <div>
                                            <textarea placeholder="Расскажите подробно о себе: про ваш опыт, навыки и преимущества, как давно работаете, что умеете. Это поможет клиентам лучше узнать вас." name="about_text" class="form-control">{{Auth::user()->about_text}}</textarea>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between form__buttons align-items-center">
                                            <button type="submit" class="btn btn-primary">
                                                Сохранить
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="profile-base-info">
                           @include("user.about")
                        </div>





                    </section>

                    <section class="user-text-default">
                            <div class="user-profile__info-section-title d-flex align-content-center align-items-center">Примеры работ <a href="{{route('user.profile.portfolio')}}" class="edit-profile-block"><i><svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.69478 11.3369L0.432779 13.8776C0.396408 13.9508 0.387505 14.031 0.407172 14.1082C0.426839 14.1854 0.474213 14.2563 0.543419 14.3121C0.612626 14.3678 0.700622 14.406 0.796498 14.4218C0.892375 14.4377 0.991915 14.4305 1.08278 14.4012L4.23778 13.3846C4.74075 13.2226 5.19765 12.9801 5.58078 12.6717L16.4998 3.875C16.8976 3.55453 17.1211 3.11988 17.1211 2.66667C17.1211 2.21345 16.8976 1.7788 16.4998 1.45833C16.102 1.13786 15.5624 0.957825 14.9998 0.957825C14.4372 0.957825 13.8976 1.13786 13.4998 1.45833L2.57978 10.255C2.19689 10.5636 1.89581 10.9317 1.69478 11.3369V11.3369Z" fill="#7D2AEB"/>
                                        </svg>
                                    </i></a>
                            </div>

                        <div class="text-info-empty">
                            Добавьте фото примеров ваших работ и скрины отзывов. Так вы будете вызывать больше<br/>доверия у заказчиков.
                        </div>
                        <div class="section__profile-gallery"> @if(!empty($Photos)&&$Photos->count())
                            <div class="swiper swiper-profile-gallery">
                                <div class="swiper-wrapper">

                                        @foreach($Photos as $photo)
                                            <div class="swiper-slide">
                                                <a href="{{ asset("storage".str_replace("_small","_big",$photo->path)) }}" data-fancybox="gallery">
                                                    <img src="{{ asset("storage".$photo->path) }}" />
                                                </a>
                                            </div>
                                        @endforeach

                                </div>
                            </div>

                            <div class="swiper-button-prev">
                                <i><svg width="16" height="8" viewBox="0 0 16 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 4.00006C16 4.19897 15.921 4.38973 15.7803 4.53039C15.6397 4.67104 15.4489 4.75006 15.25 4.75006L2.66 4.75006L4.76 6.70006C4.83223 6.76703 4.89055 6.84757 4.93165 6.93709C4.97275 7.02661 4.99582 7.12334 4.99953 7.22177C5.00325 7.3202 4.98754 7.4184 4.9533 7.51076C4.91907 7.60312 4.86697 7.68783 4.8 7.76006C4.66474 7.90593 4.47707 7.99209 4.27828 7.99959C4.17985 8.0033 4.08166 7.98759 3.9893 7.95336C3.89694 7.91912 3.81223 7.86703 3.74 7.80006L0.239999 4.55006C0.164271 4.47985 0.103857 4.39476 0.0625416 4.30012C0.0212266 4.20548 -9.76154e-05 4.10332 -9.76245e-05 4.00006C-9.76335e-05 3.89679 0.0212265 3.79464 0.0625416 3.7C0.103857 3.60535 0.164271 3.52026 0.239999 3.45006L3.74 0.200056C3.88587 0.0647956 4.07949 -0.0069789 4.27828 0.000522685C4.47707 0.00802427 4.66474 0.0941868 4.8 0.240056C4.93526 0.385925 5.00703 0.579552 4.99953 0.77834C4.99203 0.977129 4.90587 1.1648 4.76 1.30006L2.66 3.25006L15.25 3.25006C15.4489 3.25006 15.6397 3.32907 15.7803 3.46973C15.921 3.61038 16 3.80114 16 4.00006Z" fill="black"/>
                                    </svg>
                                </i>
                            </div>
                            <div class="swiper-button-next">
                                <i><svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.111328 5.00006C0.111328 4.77905 0.199125 4.56709 0.355406 4.41081C0.511686 4.25452 0.723648 4.16673 0.944661 4.16673H14.9335L12.6002 2.00006C12.52 1.92564 12.4552 1.83615 12.4095 1.73669C12.3638 1.63723 12.3382 1.52974 12.3341 1.42038C12.3299 1.31101 12.3474 1.2019 12.3854 1.09928C12.4235 0.996659 12.4814 0.902535 12.5558 0.822282C12.7061 0.660206 12.9146 0.56447 13.1355 0.556135C13.2448 0.552008 13.3539 0.569462 13.4566 0.607502C13.5592 0.645542 13.6533 0.703422 13.7336 0.777838L17.6224 4.38895C17.7066 4.46696 17.7737 4.5615 17.8196 4.66666C17.8655 4.77182 17.8892 4.88532 17.8892 5.00006C17.8892 5.1148 17.8655 5.2283 17.8196 5.33346C17.7737 5.43862 17.7066 5.53316 17.6224 5.61117L13.7336 9.22228C13.5715 9.37257 13.3563 9.45232 13.1355 9.44399C12.9146 9.43565 12.7061 9.33992 12.5558 9.17784C12.4055 9.01576 12.3257 8.80062 12.3341 8.57974C12.3424 8.35887 12.4381 8.15035 12.6002 8.00006L14.9335 5.83339H0.944661C0.723648 5.83339 0.511686 5.7456 0.355406 5.58932C0.199125 5.43304 0.111328 5.22107 0.111328 5.00006Z" fill="black"/>
                                    </svg>
                                </i>
                            </div>@endif
                        </div>

                        <a class="user-portfolio-add" href="{{route('user.profile.portfolio')}}"><i><svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 5.92212C0 5.39169 0.210714 4.88298 0.585786 4.50791C0.960859 4.13283 1.46957 3.92212 2 3.92212H2.93C3.25918 3.92217 3.58329 3.84096 3.87357 3.68571C4.16384 3.53045 4.4113 3.30595 4.594 3.03212L5.406 1.81212C5.5887 1.53829 5.83616 1.31378 6.12643 1.15853C6.41671 1.00327 6.74082 0.92207 7.07 0.922119H10.93C11.2592 0.92207 11.5833 1.00327 11.8736 1.15853C12.1638 1.31378 12.4113 1.53829 12.594 1.81212L13.406 3.03212C13.5887 3.30595 13.8362 3.53045 14.1264 3.68571C14.4167 3.84096 14.7408 3.92217 15.07 3.92212H16C16.5304 3.92212 17.0391 4.13283 17.4142 4.50791C17.7893 4.88298 18 5.39169 18 5.92212V12.9221C18 13.4526 17.7893 13.9613 17.4142 14.3363C17.0391 14.7114 16.5304 14.9221 16 14.9221H2C1.46957 14.9221 0.960859 14.7114 0.585786 14.3363C0.210714 13.9613 0 13.4526 0 12.9221V5.92212ZM13.5 8.92212C13.5 9.51307 13.3836 10.0982 13.1575 10.6442C12.9313 11.1902 12.5998 11.6862 12.182 12.1041C11.7641 12.522 11.268 12.8534 10.7221 13.0796C10.1761 13.3057 9.59095 13.4221 9 13.4221C8.40905 13.4221 7.82389 13.3057 7.27792 13.0796C6.73196 12.8534 6.23588 12.522 5.81802 12.1041C5.40016 11.6862 5.06869 11.1902 4.84254 10.6442C4.6164 10.0982 4.5 9.51307 4.5 8.92212C4.5 7.72864 4.97411 6.58405 5.81802 5.74014C6.66193 4.89622 7.80653 4.42212 9 4.42212C10.1935 4.42212 11.3381 4.89622 12.182 5.74014C13.0259 6.58405 13.5 7.72864 13.5 8.92212ZM9 11.9221C9.39397 11.9221 9.78407 11.8445 10.1481 11.6938C10.512 11.543 10.8427 11.322 11.1213 11.0434C11.3999 10.7649 11.6209 10.4341 11.7716 10.0702C11.9224 9.70619 12 9.31608 12 8.92212C12 8.52815 11.9224 8.13805 11.7716 7.77407C11.6209 7.41009 11.3999 7.07937 11.1213 6.8008C10.8427 6.52222 10.512 6.30124 10.1481 6.15048C9.78407 5.99972 9.39397 5.92212 9 5.92212C8.20435 5.92212 7.44129 6.23819 6.87868 6.8008C6.31607 7.36341 6 8.12647 6 8.92212C6 9.71777 6.31607 10.4808 6.87868 11.0434C7.44129 11.606 8.20435 11.9221 9 11.9221Z" fill="white"/>
                                </svg>
                            </i>Добавить</a>

                    </section>

                    <section class="user-text-default">
                            <div class="user-profile__info-section-title d-flex align-content-center align-items-center">Города и районы <a href="{{route("user.profile.regions")}}" class="edit-profile-block"><i><svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.69478 11.3369L0.432779 13.8776C0.396408 13.9508 0.387505 14.031 0.407172 14.1082C0.426839 14.1854 0.474213 14.2563 0.543419 14.3121C0.612626 14.3678 0.700622 14.406 0.796498 14.4218C0.892375 14.4377 0.991915 14.4305 1.08278 14.4012L4.23778 13.3846C4.74075 13.2226 5.19765 12.9801 5.58078 12.6717L16.4998 3.875C16.8976 3.55453 17.1211 3.11988 17.1211 2.66667C17.1211 2.21345 16.8976 1.7788 16.4998 1.45833C16.102 1.13786 15.5624 0.957825 14.9998 0.957825C14.4372 0.957825 13.8976 1.13786 13.4998 1.45833L2.57978 10.255C2.19689 10.5636 1.89581 10.9317 1.69478 11.3369V11.3369Z" fill="#7D2AEB"/>
                                        </svg>
                                    </i></a>
                            </div>

                        <div class="text-info-empty">
                            Укажите удобные для работы города и районы
                        </div>
                        @if(empty($UserCitys) OR !$UserCitys->count())
                        <div class="text-info-row-empty">* Без заполнения данного блока, ваш профиль не отображаться на сайте.</div>
                        @else
                            @foreach($UserCitys as $userCity)
                                <span class="profile-user-selected">{{$userCity->name}}</span>
                            @endforeach
                        @endif

                    </section>

                    <section class="user-text-default">
                            <div class="user-profile__info-section-title d-flex align-content-center align-items-center">Услуги и цены <a href="{{route('user.profile.services')}}" class="edit-profile-block"><i><svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.69478 11.3369L0.432779 13.8776C0.396408 13.9508 0.387505 14.031 0.407172 14.1082C0.426839 14.1854 0.474213 14.2563 0.543419 14.3121C0.612626 14.3678 0.700622 14.406 0.796498 14.4218C0.892375 14.4377 0.991915 14.4305 1.08278 14.4012L4.23778 13.3846C4.74075 13.2226 5.19765 12.9801 5.58078 12.6717L16.4998 3.875C16.8976 3.55453 17.1211 3.11988 17.1211 2.66667C17.1211 2.21345 16.8976 1.7788 16.4998 1.45833C16.102 1.13786 15.5624 0.957825 14.9998 0.957825C14.4372 0.957825 13.8976 1.13786 13.4998 1.45833L2.57978 10.255C2.19689 10.5636 1.89581 10.9317 1.69478 11.3369V11.3369Z" fill="#7D2AEB"/>
                                        </svg>
                                    </i></a>
                            </div>

                        <div class="text-info-empty">
                            Добавьте категории услуг, которые вы оказываете. К каждой услуге можно указать цены.
                        </div>
                        @if(empty($UserServices) OR !$UserServices->count())
                            <div class="text-info-row-empty">* Без заполнения данного блока, ваш профиль не отображаться на сайте.</div>
                        @else
                            @foreach($UserServices as $userService)
                                <span class="profile-user-selected">{{$userService->name}}</span>
                            @endforeach
                        @endif


                    </section>

                    <section class="user-text-default">
                            <div class="user-profile__info-section-title d-flex align-content-center align-items-center">Скидка <a href="#" class="edit-profile-block edit-profile-discount-info"><i><svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.69478 11.3369L0.432779 13.8776C0.396408 13.9508 0.387505 14.031 0.407172 14.1082C0.426839 14.1854 0.474213 14.2563 0.543419 14.3121C0.612626 14.3678 0.700622 14.406 0.796498 14.4218C0.892375 14.4377 0.991915 14.4305 1.08278 14.4012L4.23778 13.3846C4.74075 13.2226 5.19765 12.9801 5.58078 12.6717L16.4998 3.875C16.8976 3.55453 17.1211 3.11988 17.1211 2.66667C17.1211 2.21345 16.8976 1.7788 16.4998 1.45833C16.102 1.13786 15.5624 0.957825 14.9998 0.957825C14.4372 0.957825 13.8976 1.13786 13.4998 1.45833L2.57978 10.255C2.19689 10.5636 1.89581 10.9317 1.69478 11.3369V11.3369Z" fill="#7D2AEB"/>
                                        </svg>
                                    </i></a>
                            </div>

                        <div class="text-info-empty">
                            Скидка или подарок, может стать вашим конкурентым преимущество в привлечении клиентов
                        </div>

                        <div class="profile-edit-discount-info d-none">
                            <form method="POST" action="{{ route('user.discount') }}/" name="form-user-about">
                                @csrf
                                <div class="form-ui-style-default">


                                    <div class="form-group">
                                        <label for="name">Размер скидки <i class="requred">*</i></label>

                                        <div>
                                            <select class="form-control" name="discount">
                                                <option @if(Auth::user()->discount==5) selected @endif value="5">5%</option>
                                                <option @if(Auth::user()->discount==10) selected @endif value="10">10%</option>
                                                <option @if(Auth::user()->discount==15) selected @endif value="15">15%</option>
                                                <option @if(Auth::user()->discount==20) selected @endif value="20">20%</option>
                                                <option @if(Auth::user()->discount==30) selected @endif value="30">30%</option>
                                                <option @if(Auth::user()->discount==40) selected @endif value="40">40%</option>
                                                <option @if(Auth::user()->discount==50) selected @endif value="50">50%</option>
                                                <option @if(Auth::user()->discount==100) selected @endif value="100">Бесплатно</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="form-group">

                                        <label>Условия предоставления скидки или подарка</label>


                                        <div>
                                            <textarea maxlength="140" placeholder="Опишите на что и какие условия предоставления скидки" name="discount_text" class="form-control">{{Auth::user()->discount_text}}</textarea>
                                        </div>

                                    </div>





                                    @if ($errors->any() && !empty(session('UserSettings')))
                                        <div class="form-validation-errors  alert alert-danger  ">
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <div class="">
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between form__buttons align-items-center">
                                            <button type="submit" class="btn btn-primary">
                                                Сохранить
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="profile-discount-info">
                            @include("user.discount")
                        </div>



                    </section>

                </div>


            </div>
        </div>
    </div>
@endsection
