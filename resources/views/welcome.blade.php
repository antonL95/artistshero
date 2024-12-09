@php
    use App\Models\Post;
    use App\Models\Product;
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <section class="relative w-full scroll-mt-[520px] md:flex md:h-[730px]" id="intro">
        <img
            class="absolute right-0 top-0 z-[-1] hidden md:block"
            src="{{ asset('img/hero_section.jpg') }}"
            alt="{{ config('app.name') }}"
        />
        <div class="container mx-auto">
            <section class="max-w-3xl md:mt-24">
                <h1 class="whitespace-pre-line text-[2rem] font-medium md:whitespace-normal md:text-7xl">
                    {{ __('hero.title') }}
                </h1>
                <h3 class="text-xl">
                    <div class="relative inline-block h-[33px] w-[226px]">
                        <span class="absolute animate-topToBottom opacity-0">
                            {{ __('hero.subtitle1') }}
                        </span>
                        <span class="absolute animate-topToBottom opacity-0" style="animation-delay: 5s">
                            {{ __('hero.subtitle2') }}
                        </span>
                        <span class="absolute animate-topToBottom opacity-0" style="animation-delay: 10s">
                            {{ __('hero.subtitle3') }}
                        </span>
                        <span class="absolute bottom-0 md:bottom-[-3px]">
                            <svg
                                class="w-[155px] md:w-[188px]"
                                viewBox="0 0 188 9"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M0.5 7.5C0.5 7.5 36 1.5 94 1.5C152 1.5 187.5 7.5 187.5 7.5"
                                    stroke="#CCCCCC"
                                    strokeWidth="2"
                                />
                            </svg>
                        </span>
                    </div>
                    &nbsp;
                    <div class="relative block">
                        {{ __('hero.subtitle') }}
                    </div>
                </h3>
            </section>
            <section class="md:hidden">
                <img src="{{ asset('img/hero_section.jpg') }}" alt="{{ config('app.name') }}"/>
            </section>
        </div>
    </section>
    <section class="scroll-mt-[520px] bg-black py-4 text-white md:py-16" id="why">
        <div class="container mx-auto grid grid-cols-1 md:flex md:w-9/12 md:flex-col md:justify-between">
            <h2 class="text-center text-5xl font-medium">
                {{ __('why.heading') }}
            </h2>
            <img
                src="{{ asset('img/why_section.jpg') }}"
                alt="{{ config('app.name') }} - why art"
                class="mt-4 md:mt-20 md:self-center"
            />
            <article class="hidden whitespace-pre-line md:mt-16 md:block md:w-9/12">
                {!! __('why.content') !!}
            </article>
            <x-spoiler :content="__('why.content')" class="md:hidden"/>
        </div>
    </section>
    <section class="scroll-mt-[520px] bg-white py-4 text-black md:py-16" id="benefits">
        <div class="mx-auto grid grid-cols-1 md:grid-cols-2 md:justify-items-center">
            <div class="mt-16 flex md:mt-20 md:w-8/12">
                <div class="h-6 w-6 md:pl-0">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M29.4148 21.6663L23.08 15.3304L29.4137 8.99638C29.7889 8.62155 29.9999 8.11303 30.0002 7.58268C30.0005 7.05233 29.7901 6.54356 29.4154 6.16828L29.4137 6.16628L25.8337 2.58628C25.4588 2.21102 24.9502 2.00004 24.4198 1.99976C23.8894 1.99947 23.3806 2.20991 23.0053 2.58478L23.0036 2.58628L16.67 8.91928L10.3352 2.58378C9.9596 2.20978 9.4511 1.99984 8.92105 1.99993C8.391 2.00003 7.88257 2.21014 7.5071 2.58428L2.5854 7.50618C2.21055 7.8814 1.99998 8.39009 1.99998 8.92048C1.99998 9.45087 2.21055 9.95956 2.5854 10.3348L8.9192 16.6693L2 23.5882V29.9999H8.4106L15.3296 23.0805L21.665 29.4169C22.0411 29.7903 22.5496 29.9999 23.0796 29.9999C23.6095 29.9999 24.118 29.7903 24.4941 29.4169L29.4148 24.4946C29.7896 24.1194 30.0001 23.6107 30.0001 23.0804C30.0001 22.5501 29.7896 22.0415 29.4148 21.6663ZM24.4133 3.99628L28.0033 7.58628L21.67 13.9199L18.08 10.3299L24.4133 3.99628ZM8 27.9999H4V24.4085L10.3291 18.0799L14.0061 21.7577L8 27.9999ZM23.08 28.0034L4 8.92118L8.9219 3.99988L12.71 7.78738L10.458 10.0399L11.8733 11.454L14.124 9.20198L18.2534 13.3314L16 15.5833L17.416 16.9974L19.6677 14.7454L23.7977 18.8754L21.546 21.1264L22.9601 22.5414L25.2117 20.2899L28.0024 23.0809L23.08 28.0034Z"
                            fill="#666666"
                        />
                    </svg>
                </div>
                <div class="px-5">
                    <h2 class="flex flex-row text-2xl">
                        {{ __('benefits.creativity.heading') }}
                    </h2>
                    <h3 class="font-urbanist text-6xl font-extralight text-black">61 %</h3>
                    <p class="mb-8 mt-2 text-lg text-gray-60">
                        {!! __('benefits.creativity.subheading') !!}
                    </p>
                    <article
                        class="mt-4 overflow-y-hidden whitespace-pre-line max-md:hidden">
                        {!! __('benefits.creativity.content') !!}
                    </article>
                    <x-spoiler :content="__('benefits.creativity.content')" class="md:hidden"/>
                </div>
            </div>
            <div class="mt-16 flex md:mt-20 md:w-8/12">
                <div class="h-6 w-6 md:pl-0">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M26 13C27.0605 12.9988 28.0772 12.577 28.8271 11.8271C29.577 11.0772 29.9988 10.0605 30 9V6H27C25.9762 6.00167 24.9924 6.39794 24.2532 7.1064C23.7352 6.16633 22.9746 5.38231 22.0507 4.83597C21.1268 4.28964 20.0733 4.00096 19 4H16V7C16.0017 8.59076 16.6344 10.1159 17.7593 11.2407C18.8841 12.3656 20.4092 12.9983 22 13H23V26H11V21H12C13.0605 20.9988 14.0772 20.577 14.8271 19.8271C15.577 19.0772 15.9988 18.0605 16 17V14H13C11.9762 14.0017 10.9924 14.3979 10.2532 15.1064C9.73518 14.1663 8.97462 13.3823 8.05072 12.836C7.12682 12.2896 6.07335 12.001 5 12H2V15C2.00175 16.5908 2.63445 18.1159 3.75929 19.2407C4.88413 20.3656 6.40924 20.9983 8 21H9V26H2V28H30V26H25V13H26ZM25 10C25.0005 9.46973 25.2114 8.96133 25.5864 8.58637C25.9613 8.21141 26.4697 8.00053 27 8H28V9C27.9995 9.53027 27.7886 10.0387 27.4136 10.4136C27.0387 10.7886 26.5303 10.9995 26 11H25V10ZM11 18C11.0005 17.4697 11.2114 16.9613 11.5864 16.5864C11.9613 16.2114 12.4697 16.0005 13 16H14V17C13.9995 17.5303 13.7886 18.0387 13.4136 18.4136C13.0387 18.7886 12.5303 18.9995 12 19H11V18ZM9 19H8C6.9395 18.9988 5.92278 18.577 5.17289 17.8271C4.423 17.0772 4.00119 16.0605 4 15V14H5C6.0605 14.0012 7.07722 14.423 7.82711 15.1729C8.577 15.9228 8.99881 16.9395 9 18V19ZM23 11H22C20.9395 10.9988 19.9228 10.577 19.1729 9.82711C18.423 9.07722 18.0012 8.0605 18 7V6H19C20.0605 6.00119 21.0772 6.423 21.8271 7.17289C22.577 7.92278 22.9988 8.9395 23 10V11Z"
                            fill="#666666"
                        />
                    </svg>
                </div>
                <div class="px-5">
                    <h2 class="flex flex-row text-2xl">
                        {{ __('benefits.wellbeing.heading') }}
                    </h2>
                    <h3 class="font-urbanist text-6xl font-extralight text-black">94 %</h3>
                    <p class="mb-8 mt-2 text-lg text-gray-60">
                        {!! __('benefits.wellbeing.subheading') !!}
                    </p>
                    <article
                        class="mt-4 overflow-y-hidden whitespace-pre-line max-md:hidden">
                        {!! __('benefits.wellbeing.content') !!}
                    </article>
                    <x-spoiler :content="__('benefits.wellbeing.content')" class="md:hidden"/>
                </div>
            </div>
            <img
                src="{{ asset('img/benefits_1.jpg') }}"
                alt="{{ config('app.name') }} - benefit identity"
                class="mt-16 md:mt-20"
            />
            <div class="mt-16 flex md:mt-20 md:w-8/12">
                <div class="h-6 w-6 md:pl-0">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 14C11.1046 14 12 13.1046 12 12C12 10.8954 11.1046 10 10 10C8.89543 10 8 10.8954 8 12C8 13.1046 8.89543 14 10 14Z"
                            fill="#666666"
                        />
                        <path
                            d="M16 11C17.1046 11 18 10.1046 18 9C18 7.89543 17.1046 7 16 7C14.8954 7 14 7.89543 14 9C14 10.1046 14.8954 11 16 11Z"
                            fill="#666666"
                        />
                        <path
                            d="M22 14C23.1046 14 24 13.1046 24 12C24 10.8954 23.1046 10 22 10C20.8954 10 20 10.8954 20 12C20 13.1046 20.8954 14 22 14Z"
                            fill="#666666"
                        />
                        <path
                            d="M23 20C24.1046 20 25 19.1046 25 18C25 16.8954 24.1046 16 23 16C21.8954 16 21 16.8954 21 18C21 19.1046 21.8954 20 23 20Z"
                            fill="#666666"
                        />
                        <path
                            d="M19 25C20.1046 25 21 24.1046 21 23C21 21.8954 20.1046 21 19 21C17.8954 21 17 21.8954 17 23C17 24.1046 17.8954 25 19 25Z"
                            fill="#666666"
                        />
                        <path
                            d="M16.54 1.99992C14.6566 1.92722 12.7778 2.23558 11.0165 2.90653C9.25507 3.57747 7.64731 4.59717 6.28955 5.90451C4.93179 7.21184 3.852 8.77988 3.11491 10.5146C2.37781 12.2494 1.9986 14.1151 2 15.9999C1.99995 16.7412 2.1709 17.4726 2.49955 18.1371C2.8282 18.8016 3.30569 19.3813 3.8949 19.8312C4.4841 20.2811 5.16914 20.589 5.89674 20.731C6.62433 20.873 7.37488 20.8452 8.09 20.6499L9.21 20.3399C9.65555 20.2183 10.1232 20.2012 10.5764 20.2899C11.0296 20.3787 11.4563 20.5708 11.8231 20.8515C12.1898 21.1322 12.4869 21.4937 12.691 21.908C12.8952 22.3223 13.0009 22.7781 13 23.2399V26.9999C13 27.7956 13.3161 28.5586 13.8787 29.1212C14.4413 29.6838 15.2044 29.9999 16 29.9999C17.8848 30.0013 19.7506 29.6221 21.4853 28.885C23.22 28.1479 24.7881 27.0681 26.0954 25.7104C27.4028 24.3526 28.4225 22.7449 29.0934 20.9835C29.7643 19.2221 30.0727 17.3434 30 15.4599C29.8549 11.9366 28.3902 8.59665 25.8968 6.10317C23.4033 3.60969 20.0633 2.14501 16.54 1.99992ZM24.65 24.3099C23.5334 25.479 22.1909 26.4089 20.7039 27.0432C19.217 27.6775 17.6166 28.003 16 27.9999C15.7348 27.9999 15.4804 27.8946 15.2929 27.707C15.1054 27.5195 15 27.2651 15 26.9999V23.2399C15 21.9138 14.4732 20.6421 13.5355 19.7044C12.5979 18.7667 11.3261 18.2399 10 18.2399C9.55065 18.2407 9.1034 18.3012 8.67 18.4199L7.55 18.7299C7.13168 18.842 6.69316 18.8563 6.26844 18.7716C5.84373 18.6869 5.44422 18.5055 5.10092 18.2415C4.75761 17.9775 4.47972 17.6379 4.2888 17.2492C4.09788 16.8605 3.99906 16.433 4 15.9999C3.99876 14.3837 4.32402 12.7839 4.95625 11.2965C5.58848 9.80909 6.51467 8.46472 7.67923 7.34405C8.8438 6.22338 10.2227 5.3495 11.7333 4.77485C13.2439 4.2002 14.855 3.93662 16.47 3.99992C19.4772 4.15654 22.3198 5.42159 24.4491 7.55087C26.5783 9.68016 27.8434 12.5227 28 15.5299C28.0688 17.1459 27.8072 18.7589 27.2312 20.2703C26.6552 21.7817 25.7769 23.1597 24.65 24.3199V24.3099Z"
                            fill="#666666"
                        />
                    </svg>
                </div>
                <div class="px-5">
                    <h2 class="flex flex-row text-2xl">
                        {{ __('benefits.identity.heading') }}
                    </h2>
                    <h3 class="font-urbanist text-6xl font-extralight text-black">75 %</h3>
                    <p class="mb-8 mt-2 text-lg text-gray-60">
                        {!! __('benefits.identity.subheading') !!}
                    </p>
                    <article
                        class="mt-4 overflow-y-hidden whitespace-pre-line max-md:hidden">
                        {!! __('benefits.identity.content') !!}
                    </article>
                    <x-spoiler :content="__('benefits.identity.content')" class="md:hidden"/>
                </div>
            </div>
            <div class="mt-16 flex md:mt-20 md:w-8/12">
                <div class="h-6 w-6 md:pl-0">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.303 10C17.9473 10 17.5952 10.0713 17.2675 10.2097C16.9398 10.3481 16.6431 10.5508 16.3951 10.8058L16.0019 11.2112L15.6049 10.8058C15.3569 10.5508 15.0603 10.3481 14.7326 10.2097C14.4049 10.0713 14.0528 10 13.6971 10C13.3413 10 12.9892 10.0713 12.6615 10.2097C12.3338 10.3481 12.0372 10.5508 11.7892 10.8058C11.283 11.328 11 12.0267 11 12.754C11 13.4813 11.283 14.18 11.7892 14.7022L16.0019 19L20.2108 14.7022C20.717 14.18 21 13.4813 21 12.754C21 12.0267 20.717 11.328 20.2108 10.8058C19.9628 10.5508 19.6662 10.3481 19.3385 10.2097C19.0108 10.0713 18.6587 10 18.303 10Z"
                            fill="#666666"
                        />
                        <path
                            d="M17.7358 30L16 29L20 22H26C26.2628 22.0004 26.523 21.949 26.7659 21.8487C27.0087 21.7483 27.2294 21.601 27.4152 21.4152C27.601 21.2294 27.7483 21.0087 27.8487 20.7659C27.949 20.523 28.0004 20.2628 28 20V8C28.0004 7.73723 27.949 7.47696 27.8487 7.2341C27.7483 6.99125 27.601 6.77059 27.4152 6.58479C27.2294 6.39898 27.0087 6.25168 26.7659 6.15133C26.523 6.05098 26.2628 5.99955 26 6H6C5.73723 5.99955 5.47696 6.05098 5.2341 6.15133C4.99125 6.25168 4.77059 6.39898 4.58479 6.58479C4.39898 6.77059 4.25168 6.99125 4.15133 7.2341C4.05098 7.47696 3.99955 7.73723 4 8V20C3.99955 20.2628 4.05098 20.523 4.15133 20.7659C4.25168 21.0087 4.39898 21.2294 4.58479 21.4152C4.77059 21.601 4.99125 21.7483 5.2341 21.8487C5.47696 21.949 5.73723 22.0004 6 22H15V24H6C5.47469 24.0001 4.9545 23.8967 4.46916 23.6957C3.98381 23.4947 3.54282 23.2001 3.17137 22.8286C2.79992 22.4572 2.50528 22.0162 2.30429 21.5308C2.10331 21.0455 1.99991 20.5253 2 20V8C1.99984 7.47467 2.1032 6.95445 2.30416 6.46908C2.50512 5.98371 2.79976 5.54269 3.17122 5.17122C3.54269 4.79976 3.98371 4.50512 4.46908 4.30416C4.95445 4.1032 5.47467 3.99984 6 4H26C26.5253 3.99984 27.0455 4.1032 27.5309 4.30416C28.0163 4.50512 28.4573 4.79976 28.8288 5.17122C29.2002 5.54269 29.4949 5.98371 29.6958 6.46908C29.8968 6.95445 30.0002 7.47467 30 8V20C30.0001 20.5253 29.8967 21.0455 29.6957 21.5308C29.4947 22.0162 29.2001 22.4572 28.8286 22.8286C28.4572 23.2001 28.0162 23.4947 27.5308 23.6957C27.0455 23.8967 26.5253 24.0001 26 24H21.1646L17.7358 30Z"
                            fill="#666666"
                        />
                    </svg>
                </div>
                <div class="px-5">
                    <h2 class="flex flex-row text-2xl">
                        {{ __('benefits.csr.heading') }}
                    </h2>
                    <article
                        class="mt-4 overflow-y-hidden whitespace-pre-line max-md:hidden">
                        {!! __('benefits.csr.content') !!}
                    </article>
                    <x-spoiler :content="__('benefits.csr.content')" class="md:hidden"/>
                </div>
            </div>
            <img
                src="{{ asset('img/benefits_2.jpg') }}"
                alt="{{ config('app.name') }} - benefit identity"
                class="mt-16 md:mt-20"
            />
        </div>
    </section>
    <section class="scroll-mt-[520px] bg-black py-4 text-white md:py-16" id="benefits-of-renting">
        <div>
            <h2 class="mb-3 text-center text-5xl font-medium md:mb-0">
                {{ __('rentingArt.heading') }}
            </h2>
            <div class="container mx-auto md:grid md:w-9/12 md:grid-cols-3 md:pt-24">
                <div class="py-3 md:w-10/12">
                    <h3 class="pb-8 text-3xl">
                        {{ __('rentingArt.section1.heading') }}
                    </h3>
                    <p>
                        {{ __('rentingArt.section1.text') }}
                    </p>
                </div>
                <div class="py-3 md:w-10/12">
                    <h3 class="pb-8 text-3xl">
                        {{ __('rentingArt.section2.heading') }}
                    </h3>
                    <p>
                        {{ __('rentingArt.section2.text') }}
                    </p>
                </div>
                <div class="py-3 md:w-10/12">
                    <h3 class="pb-8 text-3xl">
                        {{ __('rentingArt.section3.heading') }}
                    </h3>
                    <p>
                        {{ __('rentingArt.section3.text') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="scroll-mt-[520px] bg-white py-4 text-black md:py-16" id="how">
        <div>
            <h2 class="text-center text-5xl font-medium">
                {{ __('how.heading') }}
            </h2>
            <div class="container mx-auto justify-between md:grid md:grid-cols-4 md:pt-24">
                <div class="md:px-1">
                    <span class="flex pb-8 font-urbanist text-8xl font-thin">
                        01
                        <span class="hidden md:flex md:justify-items-center md:align-middle">
                            <svg
                                class="md:w-100 ml-10 w-[155px] md:w-[188px]"
                                viewBox="0 0 188 9"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M0.5 7.5C0.5 7.5 36 1.5 94 1.5C152 1.5 187.5 7.5 187.5 7.5"
                                    stroke="#CCCCCC"
                                    strokeWidth="2"
                                />
                            </svg>
                        </span>
                    </span>
                    <h3 class="md:pr-16l pb-8 text-3xl font-medium">
                        {{ __('how.section1.heading') }}
                    </h3>
                    <p class="md:pr-20">
                        {{ __('how.section1.text') }}
                    </p>
                </div>
                <div class="md:px-1">
                    <span class="flex pb-8 font-urbanist text-8xl font-thin">
                        02
                        <span class="hidden md:flex md:justify-items-center md:align-middle">
                            <svg
                                class="md:w-100 ml-10 w-[155px] rotate-180 md:w-[188px]"
                                viewBox="0 0 188 9"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M0.5 7.5C0.5 7.5 36 1.5 94 1.5C152 1.5 187.5 7.5 187.5 7.5"
                                    stroke="#CCCCCC"
                                    strokeWidth="2"
                                />
                            </svg>
                        </span>
                    </span>
                    <h3 class="md:pr-16l pb-8 text-3xl font-medium">
                        {{ __('how.section2.heading') }}
                    </h3>
                    <p class="md:pr-20">
                        {{ __('how.section2.text') }}
                    </p>
                </div>
                <div class="md:px-1">
                    <span class="flex pb-8 font-urbanist text-8xl font-thin">
                        03
                        <span class="hidden md:flex md:justify-items-center md:align-middle">
                            <svg
                                class="md:w-100 ml-10 w-[155px] md:w-[188px]"
                                viewBox="0 0 188 9"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M0.5 7.5C0.5 7.5 36 1.5 94 1.5C152 1.5 187.5 7.5 187.5 7.5"
                                    stroke="#CCCCCC"
                                    strokeWidth="2"
                                />
                            </svg>
                        </span>
                    </span>
                    <h3 class="md:pr-16l pb-8 text-3xl font-medium">
                        {{ __('how.section3.heading') }}
                    </h3>
                    <p class="md:pr-20">
                        {{ __('how.section3.text') }}
                    </p>
                </div>
                <div class="md:px-1">
                    <span class="flex pb-8 font-urbanist text-8xl font-thin">04</span>
                    <h3 class="md:pr-16l pb-8 text-3xl font-medium">
                        {{ __('how.section4.heading') }}
                    </h3>
                    <p class="md:pr-20">
                        {{ __('how.section4.text') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="scroll-mt-[520px] bg-white py-4 text-black md:py-16" id="latest">
        <div class="container mx-auto">
            <h2 class="py-6 text-5xl font-medium">
                {{ __('artworks.heading') }}
            </h2>
            <livewire:carousel :items="Product::with('images')->get()->toArray()"/>
        </div>
    </section>
    <div id="about" class="scroll-mt-[520px]">
        <section class="bg-white py-4 pt-0 text-black md:py-16">
            <div class="container mx-auto md:grid md:grid-cols-2">
                <div class="py-3 md:px-1">
                    <h3 class="pb-3 text-3xl font-medium md:pr-16">
                        {{ __('about.section1.heading') }}
                    </h3>
                    <p class="whitespace-pre-line md:pr-20">
                        {{ __('about.section1.text') }}
                    </p>
                </div>
                <div class="py-3 md:px-1">
                    <h3 class="pb-3 text-3xl font-medium md:pr-16">
                        {{ __('about.section2.heading') }}
                    </h3>
                    <p class="whitespace-pre-line md:pr-20">
                        {{ __('about.section2.text') }}
                    </p>
                </div>
                <div class="py-3 md:px-1 col-span-2">
                    <h3 class="pb-3 text-3xl font-medium md:pr-16">
                        {{ __('about.section3.heading') }}
                    </h3>
                    <div class="flex flex-col md:flex-row md:flex-wrap max-w-full space-y-16 md:space-x-6 md:justify-between justify-center text-center items-center">
                        <div>
                            <img src="{{ asset('img/veolia_logo.png') }}" alt="veolia" class="max-w-64">
                        </div>
                        <div>
                            <img src="{{ asset('img/proxenta_logo.png') }}" alt="proxenta" class="max-w-64">
                        </div>
                        <div>
                            <img src="{{ asset('img/capexus_logo.png') }}" alt="capexus" class="max-w-64">
                        </div>
                        <div>
                            <img src="{{ asset('img/mercedes_benz_logo.png') }}" alt="mercedes benz" class="w-52">
                        </div>
                        <div>
                            <img src="{{ asset('img/augustine_logo.png') }}" alt="augustine hotel" class="w-52">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white py-4 pt-0 text-black md:py-16">
            <h2 class="text-center text-5xl font-medium">
                {{ __('media.heading') }}
            </h2>
            <div class="container mx-auto">
                <div class="flex flex-row flex-wrap justify-around">
                    @foreach ($mediaCards as $mediaCard)
                        <div class="max-w-sm py-5">
                            <div
                                class="min-w-sm border-gray-200 dark:border-gray-700 dark:bg-gray-800 max-w-sm rounded-lg border bg-white shadow"
                            >
                                <a target="_blank" href="{{ $mediaCard['link'] }}">
                                    <img
                                        src="{{ $mediaCard['image'] }}"
                                        alt="{{ $mediaCard['name'] }}"
                                        class="h-[300px] w-full rounded-t-lg object-cover object-top"
                                    />
                                </a>
                                <div class="p-5">
                                    <div class="h-36">
                                        <h5 class="text-gray-900 mb-2 text-2xl font-medium dark:text-white">
                                            {{ $mediaCard['name'] }}
                                        </h5>
                                    </div>
                                    <div class="pb-5">
                                        <x-link-button
                                            target="_blank"
                                            href="{{ $mediaCard['link'] }}"
                                            class="border border-black bg-white text-black hover:bg-black hover:text-white"
                                        >
                                            {{ __('other.readMore') }}
                                        </x-link-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="bg-white py-4 pt-0 text-black md:py-16">
            <h2 class="text-center text-5xl font-medium">
                {{ __('blog.heading') }}
            </h2>
            <div class="container mx-auto">
                <div class="flex flex-row flex-wrap justify-around">
                    @foreach (Post::with(['images', 'coverImage'])->get() as $post)
                        <div class="max-w-sm py-5">
                            <div
                                class="min-w-sm border-gray-200 dark:border-gray-700 dark:bg-gray-800 max-w-sm rounded-lg border bg-white shadow"
                            >
                                <a target="_blank" href="{{ route('blog.post', $post->id) }}">
                                    <img
                                        src="{{ $post->thumbnail->url }}"
                                        alt="{{ $post->title }}"
                                        class="h-[300px] w-full rounded-t-lg object-cover object-top"
                                    />
                                </a>
                                <div class="p-5">
                                    <div class="h-36">
                                        <h5 class="text-gray-900 mb-2 text-2xl font-medium dark:text-white">
                                            {{ $post->title }}
                                        </h5>
                                    </div>
                                    <div class="pb-5">
                                        <x-link-button
                                            target="_blank"
                                            href="{{ route('blog.post', ['id' => $post->id]) }}"
                                            class="border border-black bg-white text-black hover:bg-black hover:text-white"
                                        >
                                            {{ __('other.readMore') }}
                                        </x-link-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
