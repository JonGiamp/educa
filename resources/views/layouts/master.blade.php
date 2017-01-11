<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>@yield("title")</title>
        @include("subviews.head")
    </head>
    <body>
        @include("subviews.header")
        @include("subviews.nav")
        @yield("content")
        @include("subviews.footer")
        @yield("script")
    </body>
</html>
