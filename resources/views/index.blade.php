@inject('content', 'App\Services\ContentPieceService')

<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $content->__('frontpage.seo.title') }}</title>

    <meta name="description" content="{{ $content->__('frontpage.seo.meta.description') }}" />

    <meta name="og:type" content="website" />
    <meta name="og:url" content="{{ url()->current() }}" />
    @if($content->exists('frontpage.seo.og.title'))
        <meta property="og:title" content="{{ $content->__('frontpage.seo.og.title') }}" />
    @endif
    @if($content->exists('frontpage.seo.og.image'))
        <meta property="og:image" content="{{ $content->__('frontpage.seo.og.title') }}" />
    @endif

    @if(app()->isLocale('en'))
        <link rel=”alternate” hreflang=”de-de” href=”{{ request()->getSchemeAndHttpHost() . '/de' }}” />
    @else
        <link rel=”alternate” hreflang=”en-us” href=”{{ request()->getSchemeAndHttpHost() . '/en' }}” />
    @endif

    <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">

    @vite('resources/css/app.css')

</head>
<body>

<div id="loader" class="fixed left-0 top-0 w-full h-full bg-loader bg-center bg-no-repeat bg-white z-50"></div>

<div class="relative overflow-x-hidden w-full h-full">
    <header class="relative h-600 w-full bg-transparent bg-cover bg-fixed js-fullheight" @if($content->exists('frontpage.images.splash')) style="background-image: url('{{ $content->media('frontpage.images.splash')?->getUrl() ?? null }}');" @endif role="banner" data-stellar-background-ratio="0.5">
        <div class="absolute top-0 bottom-0 left-0 right-0 bg-brand bg-opacity-90"></div>
        <div class="flex h-screen">
            <div class="m-auto text-center transition-opacity ease-in duration-200 opacity-0 js-show-on-loaded">
                <div class="relative w-[200px] h-[200px] rounded-full my-0 mx-auto mb-[30px] bg-cover bg-center bg-no-repeat" @if($content->exists('frontpage.images.profile')) style="background-image: url('{{ $content->media('frontpage.images.profile')?->getUrl('content') ?? null }}');" @endif></div>
                <h1 class="mb-6 text-white text-[50px] font-kaushan font-[300] -rotate-6">
                    <span class="relative px-[15px] py-[4px] before:absolute before:top-[40px] before:left-0 before:w-[30px] before:h-[4px] before:bg-white before:content-[''] before:ml-[-30px] after:absolute after:top-[40px] after:right-0 after:w-[30px] after:h-[4px] after:bg-white after:content-[''] after:mr-[-30px]">{{ $content->__('frontpage.splash.title') }}</span>
                </h1>
                <h3 class="text-white rotate-0 font-[400] mb-4"><span>{{ $content->__('frontpage.splash.subtitle') }}</span></h3>
            </div>
        </div>
    </header>

    <div class="py-14 px-0">
        <div class="mx-auto max-w-7xl">
            <div class="mb-24 text-center">
                <h2 class="text-[40px] mb-[20px] text-black">{{ $content->__('frontpage.headlines.about') }}</h2>
            </div>
            <div class="grid grid-cols-1 px-4 lg:px-0 lg:grid-cols-3 gap-4 w-full">
                <div class="col-span-full lg:col-span-1 mb-8 lg:mb-0 px-4">
                    <div class="grid grid-cols-10 gap-4">
                        <div class="col-span-3 font-bold">{{ $content->__('frontpage.about.label.name') }}:</div><div class="col-span-7">{{ $content->__('frontpage.about.content.name') }}</div>
                        <div class="col-span-3 font-bold">{{ $content->__('frontpage.about.label.phone') }}:</div><div class="col-span-7">{{ $content->__('frontpage.about.content.phone') }}</div>
                        <div class="col-span-3 font-bold">{{ $content->__('frontpage.about.label.email') }}:</div><div class="col-span-7">{{ $content->__('frontpage.about.content.email') }}</div>
                        <div class="col-span-3 font-bold">{{ $content->__('frontpage.about.label.address') }}:</div><div class="col-span-7">{!! nl2br($content->__('frontpage.about.content.address')) !!}</div>
                    </div>
                </div>
                <div class="col-span-full lg:col-span-2 px-4">
                    <h2 class="text-[30px] font-[400] leading-[24px] mb-6">{{ $content->__('frontpage.about.headline') }}</h2>
                    <p class="mb-8">{!! nl2br($content->__('frontpage.about.text')) !!}</p>
                    <p>
                        <ul class="flex flex-wrap text-white text-[20px] font-[400]">
                            @foreach($socials as $social)
                                <li>
                                    <a href="{{ $social->url }}" target="_blank" rel="nofollow" class="block bg-black rounded-[2px] w-[40px] h-[40px] mr-2 flex items-center justify-center transition-colors ease-in-out hover:bg-brand duration-300">
                                        @svg($social->icon, 'w-[30px] h-[30px]')
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-24 mt-20 bg-contrary">
        <div class="mx-auto max-w-7xl">
            <div class="w-full text-center">
                <h2 class="text-white text-[40px] mb-24">{{ $content->__('frontpage.headlines.resume') }}</h2>
            </div>
            <div class="relative">
                <div class="absolute w-[2px] h-full lg:transform -lg:translate-x-1/2 bg-gray-300 dark:bg-gray-600 block left-[40px] lg:left-1/2 z-0 mt-8">
                </div>
                @foreach($projectCategories as $category => $projects)
                    <div class="text-left lg:text-center pt-8">
                        <span class="relative bg-gray-300 rounded-[4px] tracking-[5px] uppercase text-[18px] font-[700] px-[15px] py-[7px] ml-[15px] lg:mx-auto z-10">{{ $projects->first()->category->title }}</span>
                        <div class="mt-10">
                            @foreach ($projects as $project)
                                <div class="absolute lg:left-1/2 w-[44px] h-[44px] ml-[19px] lg:-ml-[22px] rounded-full bg-brand text-white mx-auto flex items-center justify-center">
                                    <i class="icon-suitcase text-[18px]"></i>
                                </div>
                                <div class="relative mb-8 w-full flex items-center justify-start text-left pl-24 {{ $loop->iteration % 2 == 0 ? 'lg:justify-end lg:pl-20' : 'lg:text-right lg:pr-20 lg:pl-0' }}">
                                    <div class="w-full lg:w-1/2 {{ $loop->iteration % 2 == 0 ? 'lg:pr-4' : 'lg:pl-4' }}">
                                        <div class="mb-5">
                                            <h3 class="text-[24px] text-stone-300 mb-5">{{ $project->title }}</h3>
                                            <span class="text-[16px] text-white">{{ $project->location }} - {{ $project->started_at->format('m/Y') }} - {{ !empty($project->finished_at) ? $project->finished_at->format('m/Y') : 'Current' }}</span>
                                        </div>
                                        <div class="text-[16px] text-stone-400">
                                            <p>{{ $project->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="bg-brand">
        <div class="mx-auto max-w-7xl text-center py-24">
            <h2 class="text-[40px] text-white font-[400] mb-24">{{ $content->__('frontpage.headlines.services') }}</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach($services as $service)
                    <div class="text-center px-2">
                        <div class="mb-8">
                            <div class="mx-auto mb-4 bg-white rounded-full w-[100px] h-[100px] flex items-center justify-center">
                                @svg($service->icon, 'text-brand w-[60px]')
                            </div>
                            <div class="text-white">
                                <h3 class="text-[24px] mb-6">{{ $service->name }}</h3>
                                <p class="leading-[27px] text-[16px] font-[400] text-white text-opacity-75">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="mx-auto max-w-7xl mt-24 text-center">
            <h2 class="mb-24 text-[40px] font-[400] text-black">{{ $content->__('frontpage.headlines.skills') }}</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-24">
                @foreach ($skills as $skill)
                    <div class="flex items-center justify-center mb-10">
                        <svg class="transform -rotate-90 w-[160px] h-[160px]">
                            <circle cx="80" cy="80" r="78" stroke="currentColor" stroke-width="4" fill="transparent"
                                    class="text-gray-100" />

                            <circle cx="80" cy="80" r="78" stroke="currentColor" stroke-width="4" fill="transparent"
                                    stroke-dasharray="{{ ($skill->percent * (2 * pi() * 78)) / 100 }} {{ (2 * pi() * 78) }}"
                                    stroke-dashoffset="0"
                                    class="text-brand" />
                        </svg>
                        <span class="absolute text-[16px] font-bold">{{ $skill->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
{{--
    <div class="bg-contrary py-24">
        <div class="mx-auto max-w-7xl text-center">
            <h2 class="mb-24 text-[40px] font-[400] text-white">Work</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 px-4">
                <div class="aspect-square bg-[url('../images/portfolio-1.jpg')] bg-center bg-cover bg-no-repeat">
                    <a href="#" class="w-full h-full flex flex-wrap items-center justify-center transition-all hover:bg-op hover:bg-white duration-300 text-black text-opacity-0 hover:text-opacity-100">
                        <div>
                            <h3 class="text-[20px] mb-[20px]">Project Name</h3>
                            <span>Illustration</span>
                        </div>
                    </a>
                </div>
                <div class="aspect-square bg-[url('../images/portfolio-2.jpg')] bg-center bg-cover bg-no-repeat">
                    <a href="#" class="w-full h-full flex flex-wrap items-center justify-center transition-all hover:bg-op hover:bg-white duration-300 text-black text-opacity-0 hover:text-opacity-100">
                        <div>
                            <h3 class="text-[20px] mb-[20px]">Project Name</h3>
                            <span>Illustration</span>
                        </div>
                    </a>
                </div>
                <div class="aspect-square bg-[url('../images/portfolio-3.jpg')] bg-center bg-cover bg-no-repeat">
                    <a href="#" class="w-full h-full flex flex-wrap items-center justify-center transition-all hover:bg-op hover:bg-white duration-300 text-black text-opacity-0 hover:text-opacity-100">
                        <div>
                            <h3 class="text-[20px] mb-[20px]">Project Name</h3>
                            <span>Illustration</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-24">
        <div class="mx-auto max-w-7xl text-center">
            <h2 class="text-[40px] text-black">Post on Medium</h2>
            <p class="text-[18px] mt-[20px] mb-[30px] text-gray-400 max-w-3xl mx-auto px-4">Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-left mt-24 px-8 lg:px-0">
                @foreach (range(1, 3) as $blogpost)
                    <div class="mb-[30px] shadow-[0px_2px_5px_2px_rgba(0,0,0,0.06)]">
                        <div class="p-[30px]">
                            <span class="text-[18px] mb-[20px] text-black text-opacity-30">Mar. 15th 2016</span>
                            <h3 class="text-[24px] mb-[20px] text-black">
                                <a href="#" class="relative group">
                                    <span class="ease absolute bottom-0 left-0 h-0 w-0 border-b-2 border-brand transition-all duration-200 group-hover:w-full"></span>
                                    Photoshoot On The Street
                                </a>
                            </h3>
                            <p class="text-[16px] mb-[30px] text-black">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            <div class="border-t-[0.8px] border-gray-200 text-right pt-4">
                                <a href="#" class="relative group">
                                    <span class="ease absolute bottom-0 left-0 h-0 w-0 border-b-2 border-brand transition-all duration-200 group-hover:w-full"></span>
                                    Read More<i class="icon-arrow-right22 text-black text-opacity-50 ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
--}}
    <div class="bg-contrary py-24">
        <div class="mx-auto max-w-7xl text-center">
            <h2 class="text-[40px] text-white">{{ $content->__('frontpage.headlines.contact') }}</h2>
            <div class="text-white text-opacity-[0.6] max-w-3xl mx-auto mt-[20px] mb-[40px] text-justify">
                {!! nl2br($content->__('frontpage.contact.text')) !!}
            </div>
            <div class="mt-[40px]">
                <a href="mailto:{{ $content->__('frontpage.about.content.email') }}" class="px-8 py-4 bg-brand rounded-full">{{ $content->__('frontpage.contact.cta') }}</a>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-10">
    <div class="mx-auto max-w-7xl px-4">
        <p>&copy; {{ now()->format('Y') }} {{ $content->__('frontpage.about.content.name') }}. {{ $content->__('frontpage.content.all-rights-reserved') }}.</p>
    </div>
</div>

<a id="back-to-top" href="#" class="fixed right-[20px] bottom-[20px] z-[999] block rounded-full bg-black text-white w-[50px] h-[50px] opacity-50 hover:opacity-100 transition-opacity ease-in-out duration-200 flex flex-wrap items-center justify-center"><i class="icon-arrow-up22"></i></a>

@vite(['resources/js/app.js'])

</body>
</html>

