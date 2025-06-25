<!-- Place this data between the <head> tags of your website -->
    <meta name="title" content="{{$data->title}}"/>
    <meta name="description" content="{{$data->description}}" />
    <meta name="news_keywords" content="{{$data->description}}" />
    <meta name="geo.country" content="{{App::getLocale() }}" />
    <meta http-equiv="content-language" content="{{App::getLocale() }}" />
    <meta name="geo.placename" content="Indonesia" />
    <meta name="copyright" content="{{url()->full()}}">
    <meta name="creation date" content="2021">
    <meta name="keywords" content="sawit, Auriga Nusantara, sawitinfo, sawit indonesia, {{$data->tags}}">
    <link rel="canonical" href="{{url()->full()}}"/>
    <meta name="robots" content="index, follow">
    <meta name="author" content="Sawitinfo">
    <meta name="googlebot-news" content="index, follow, follow" />
    <meta name="googlebot" content="index, follow, follow" />
    <meta name="coverage" content="Sawitinfo" >

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@AURIGA_ID">
    <meta name="twitter:title" content="{{$data->title}}">
    <meta name="twitter:description" content="{{$data->description }}">
    <meta name="twitter:creator" content="@AURIGA_ID">
    <meta name="twitter:url" content="{{url()->full()}}" />
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image"  content="{{ asset('/storage/files/photos/thumbnail/'.$data->img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{$data->title}}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{url()->full()}}" />
    <!-- Facebook image must be at least 600x315px -->
    <meta property="og:image" content="{{ asset('/storage/files/photos/thumbnail/'.$data->img) }}" />
    <meta property="og:description" content="{{$data->description }}" />
    <meta property="og:site_name" content="{{$data->title}}" />
    <meta property="article:tag" content="sawit, Auriga Nusantara, sawitinfo, sawit indonesia,, {{$data->tags }}" />
