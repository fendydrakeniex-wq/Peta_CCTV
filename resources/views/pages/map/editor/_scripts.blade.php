@include('pages.map.editor._style')
@include('pages.map._layout')
@include('pages.map.editor._video')
@include('pages.map._initmap')
@include('pages.map.editor._addmarker')
@include('pages.map.editor._contextmenu')
@include('pages.map.editor._crudcamera')
@include('pages.map.editor._crudiocation')

<script>
  const locations = @json($locations);
  loadMarkers(locations, map);
</script>
