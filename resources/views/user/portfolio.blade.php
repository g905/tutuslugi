@extends('layouts.app')

@section('content')
    <div class="container">
        @include("user.menu")
        <div class="page-col-inner">


            <div class="page-col-left s-895">


                <div class="user-cabinet-section">
                    <div class="user-cabinet-title">
                        <a href="{{route('user.profile')}}"><i>
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M8.54689 0.227009C8.61882 0.298889 8.67588 0.384239 8.71482 0.478182C8.75375 0.572125 8.77379 0.672818 8.77379 0.774509C8.77379 0.8762 8.75375 0.976893 8.71482 1.07084C8.67588 1.16478 8.61882 1.25013 8.54689 1.32201L2.64289 7.22601H15.2259C15.4312 7.22601 15.628 7.30756 15.7732 7.45271C15.9183 7.59786 15.9999 7.79473 15.9999 8.00001C15.9999 8.20529 15.9183 8.40216 15.7732 8.54731C15.628 8.69246 15.4312 8.77401 15.2259 8.77401H2.64289L8.54689 14.678C8.6204 14.7495 8.67897 14.8348 8.71922 14.9291C8.75946 15.0234 8.78057 15.1248 8.78131 15.2273C8.78205 15.3299 8.76242 15.4315 8.72355 15.5264C8.68468 15.6213 8.62735 15.7075 8.55488 15.78C8.48242 15.8525 8.39626 15.9099 8.30142 15.9489C8.20658 15.9879 8.10495 16.0076 8.00242 16.0069C7.8999 16.0063 7.79852 15.9853 7.70418 15.9451C7.60985 15.905 7.52443 15.8465 7.45289 15.773L0.226887 8.54701C0.0819179 8.40188 0.000488281 8.20514 0.000488281 8.00001C0.000488281 7.79488 0.0819179 7.59814 0.226887 7.45301L7.45289 0.227009C7.59802 0.08204 7.79476 0.000610352 7.99989 0.000610352C8.20502 0.000610352 8.40176 0.08204 8.54689 0.227009Z"
                                          fill="black"/>
                                </svg>
                            </i></a> Примеры работ
                    </div>


                    <section class="user-text-default">


                        <label class="pre-form-text-info">
                            Добавьте фото примеров ваших работ и скрины отзывов. Так вы будете вызывать больше доверия у заказчиков.
                        </label>


                        <form method="POST" action="{{ route('user.discount') }}/" name="form-user-portfolio" class="form-user-portfolio">
                            @csrf
                            <div class="form-ui-style-default">


                                <div id="file-upload-form" class="uploader progress-upload">


                                    <input id="file-upload" class="file-upload-preview" multiple="" accept="image/png, image/jpg, image/jpeg" type="file"
                                           name="images[]">

                                    <label for="file-upload" id="file-images">



                                        <div id="start">
                                            <div>
                                                <i class="progress-state d-none">


                                                    <svg width="38" height="38" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
                                                        <defs>
                                                            <linearGradient x1="8.042%" y1="0%" x2="65.682%" y2="23.865%" id="a">
                                                                <stop stop-color="#8695BD" stop-opacity="0" offset="0%"/>
                                                                <stop stop-color="#8695BD" stop-opacity=".631" offset="63.146%"/>
                                                                <stop stop-color="#8695BD" offset="100%"/>
                                                            </linearGradient>
                                                        </defs>
                                                        <g fill="none" fill-rule="evenodd">
                                                            <g transform="translate(1 1)">
                                                                <path d="M36 18c0-9.94-8.06-18-18-18" id="Oval-2" stroke="url(#a)" stroke-width="2">
                                                                    <animateTransform
                                                                        attributeName="transform"
                                                                        type="rotate"
                                                                        from="0 18 18"
                                                                        to="360 18 18"
                                                                        dur="0.9s"
                                                                        repeatCount="indefinite" />
                                                                </path>
                                                                <circle fill="#fff" cx="36" cy="18" r="1">
                                                                    <animateTransform
                                                                        attributeName="transform"
                                                                        type="rotate"
                                                                        from="0 18 18"
                                                                        to="360 18 18"
                                                                        dur="0.9s"
                                                                        repeatCount="indefinite" />
                                                                </circle>
                                                            </g>
                                                        </g>
                                                    </svg>


                                                </i>
                                                <i class="default-state">
                                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.53375 7.71875C8.30874 8.07489 8.00852 8.37748 7.65417 8.60529C7.29982 8.8331 6.89991 8.98062 6.4825 9.0375C6.0075 9.105 5.53625 9.1775 5.065 9.25625C3.74875 9.475 2.8125 10.6337 2.8125 11.9675V22.5C2.8125 23.2459 3.10882 23.9613 3.63626 24.4887C4.16371 25.0162 4.87908 25.3125 5.625 25.3125H24.375C25.1209 25.3125 25.8363 25.0162 26.3637 24.4887C26.8912 23.9613 27.1875 23.2459 27.1875 22.5V11.9675C27.1875 10.6337 26.25 9.475 24.935 9.25625C24.4634 9.17767 23.9909 9.10475 23.5175 9.0375C23.1003 8.98045 22.7006 8.83285 22.3465 8.60504C21.9924 8.37724 21.6924 8.07474 21.4675 7.71875L20.44 6.07375C20.2092 5.69887 19.8915 5.38511 19.5138 5.15904C19.1361 4.93297 18.7094 4.80124 18.27 4.775C16.0916 4.65799 13.9084 4.65799 11.73 4.775C11.2906 4.80124 10.8639 4.93297 10.4862 5.15904C10.1085 5.38511 9.79077 5.69887 9.56 6.07375L8.53375 7.71875V7.71875Z" stroke="#8695BD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M20.625 15.9375C20.625 17.4293 20.0324 18.8601 18.9775 19.915C17.9226 20.9699 16.4918 21.5625 15 21.5625C13.5082 21.5625 12.0774 20.9699 11.0225 19.915C9.96763 18.8601 9.375 17.4293 9.375 15.9375C9.375 14.4457 9.96763 13.0149 11.0225 11.96C12.0774 10.9051 13.5082 10.3125 15 10.3125C16.4918 10.3125 17.9226 10.9051 18.9775 11.96C20.0324 13.0149 20.625 14.4457 20.625 15.9375V15.9375ZM23.4375 13.125H23.4475V13.135H23.4375V13.125Z" stroke="#8695BD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </i>

                                                Добавьте или перетащите сида до 20 фото. Форматы jpg, png.<br/>Размер одного фото до 10МБ.

                                            </div>
                                        </div>

                                    </label>
                                </div>




                                <div class="images-preview-inner">
                                    @if(!empty($UserPhotos))
                                        @foreach($UserPhotos as $Photo)
                                            <div class='inner-image-upload' data-image-id='{{$Photo->id}}'><i></i><img src='{{asset("storage/".$Photo->path)}}'/></div>
                                        @endforeach
                                        @endif
                                </div>





                            </div>
                        </form>
                    </section>


                </div>
            </div>
        </div>
    </div>
@endsection

