@include('pages.map.view._style')
@include('pages.map._layout')
@include('pages.map.view._video')
@include('pages.map._initmap')
@include('pages.map.view._addmarker')

<script>
  const locations = @json($locations);
  loadMarkers(locations, map);
</script>
