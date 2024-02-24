
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header bg-dark text-white">
					ABER PROJET PILOTE
				</div>
				<div class="card-body">
				<div wire:ignore id='map' style='width: 100%; height: 75vh;'></div>

				</div>
			</div>
		
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header bg-dark text-white">
					ABER PROJET PILOTE
				</div>
				<div class="card-body">
					
						<form 
						@if($isEdit)
						wire:submit.prevent="updateLocation"
						@else
						wire:submit.prevent="saveLocation"
						@endif
						>
						<div class="row">
							<div class="col-sm-6">
							<div class="form-group">
								<label for="">Longitude</label>
								<input wire:model="long" type="text" class="form-control">
								@error('long') <small class="text-danger">{{$message}}</small>@enderror
							</div>

							</div>
							<div class="col-sm-6">
							<div class="form-group">
								<label for="">Lattitude</label>
								<input wire:model="lat" type="text" class="form-control">
								@error('lat') <small class="text-danger">{{$message}}</small>@enderror
							</div>
								
							</div>
						</div>
						<div class="form-group">
								<label for="">Title</label>
								<input wire:model="title" type="text" class="form-control">
								@error('title') <small class="text-danger">{{$message}}</small>@enderror
						</div>
						<div class="form-group">
								<label for="">Description</label>
								<textarea wire:model="description" type="text" class="form-control"></textarea>
								@error('description') <small class="text-danger">{{$message}}</small>@enderror
						</div>
						<div class="form-group">
								<label >Picture</label>
							
								<div class="input-group mb-3">
								<input wire:model="image" type="file" class="form-control" id="inputGroupFile02">
								<label class="input-group-text" for="inputGroupFile02"></label>
								</div>
								@error('image') <small class="text-danger">{{$message}}</small>@enderror
								@if($image)
									<img src="{{$image->temporaryUrl()}}" class="img-fluid">
								@endif

								@if($imageUrl && !$image)
									<img src="{{asset('/storage/images/'.$imageUrl)}}" class="img-fluid">
								@endif
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-dark btn-block text-white">{{$isEdit ?"METTRE A JOUR":"ENVOYER DONNEES"}}</button>
							@if($isEdit)
							<button wire:click="deleteLocation" type="button" class="btn btn-danger btn-block text-white">SUPPRIMER DATA</button>
							@endif
						</div>

					
					</form>
					
					
				</div>
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
		var defaultLocation= [-1.52776311110361 , 12.367371476725694];
		mapboxgl.accessToken = '{{env('MAPBOX_KEY')}}';
		var map = new mapboxgl.Map({
			container: 'map', // container ID
			center:defaultLocation,
			zoom:5.6,
			style: 'mapbox://styles/mapbox/light-v10' // style URL
			});

		

		map.addControl(new mapboxgl.NavigationControl());
		

		map.on('click', (e) => {
			console.log(e);
			const longitude = e.lngLat.lng;
			const lattitude = e.lngLat.lat;

			@this.long = longitude;
			@this.lat = lattitude;

		});

		
	

		const loadLocations = (geoJson) => {
			geoJson.features.forEach((location) => {
				const {geometry, properties}=location
				const {iconSize, locationId, title, image, description} = properties

				let markerElement=document.createElement('div')
				markerElement.className= 'marker' + locationId
				markerElement.id = locationId
				markerElement.style.backgroundImage = 'url(https://static-00.iconduck.com/assets.00/mapbox-icon-2048x2048-pmda994e.png)'
				markerElement.style.backgroundSize = 'cover'
				markerElement.style.width = '10px'
				markerElement.style.height = '10px'

				const content=	`		
				<div style="overflow-y, auto;max-height:400px,width:100%">
							<table>
								<tbody>
									<tr>
										<td>Title</td>
										<td>${title}</td>

									</tr>
									<tr>
										<td>Picture</td>
										<td><img src="${image}" loading="lazy" class="img-fluid"></td>

									</tr>
									<tr>
										<td>Description</td>
										<td>${description}</td>

									</tr>
								</tbody>
							</table>
						</div> 
				`
				markerElement.addEventListener('click', (e) => {
					const locationId = e.target.id
					@this.findLocationById(locationId)
					
				}
				)
 
				const popUp= new mapboxgl.Popup({
					offset:25
				}).setHTML(content).setMaxWidth("400px")

				new mapboxgl.Marker(markerElement)
				.setLngLat(geometry.coordinates)
				.setPopup(popUp)
				.addTo(map)
			})


		}

		loadLocations({!! $geoJson !!});

		window.addEventListener('locationAdded', (e) => {
			loadLocations(JSON.parse(e.detail))
		});

		window.addEventListener('updateLocation', (e) => {
			loadLocations(JSON.parse(e.detail))
			$('.mapboxgl-popup').remove()
			
		});

		window.addEventListener('deleteLocation', (e) => {
			$('.marker' + e.detail).remove()
			$('.mapboxgl-popUp').remove()
			
		});

		
})
</script>
@endpush


