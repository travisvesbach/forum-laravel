<div class="card form-group">
    <div class="card-header">
    	<div class="level">
    		<h6 class="flex">
		        <a href="#">
		            {{ $reply->owner->name }}
		        </a> said {{ $reply->created_at->diffForHumans() }}...
			</h6>
	        <div>
	        	<form method="POST" action="/replies/{{ $reply->id }}/favorites">
	        		{{ csrf_field() }}
	        		<button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }} >
	        			{{ $reply->favorites()->count() }} {{ str_plural('Favorite',  $reply->favorites()->count() ) }}
	        		</button>
	        		
				</form>
	        </div>
    	</div>
    </div>

    <div class="card-body">

        {{ $reply->body }}
        
    </div>

</div>