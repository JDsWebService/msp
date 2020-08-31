{{-- @include('content.app.contact') --}}
<section class="contact section" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4">
            	<h1>Contact Us Today To Learn More!</h1>
            	<p>
            		Send us your information and someone will get back to you within 24 hours! To help get back to you sooner, fill out the form completely.
            	</p>
            </div>
            <div class="col-sm-8">
            	{{ Form::open(['route' => 'contact.sendemail', 'method' => 'POST']) }}
	            	<div class="row">
	            		<div class="col-sm-6">
	            			<input type="text" name="name" class="form-control" placeholder="Full Name *">
	            			<input type="text" name="email" class="form-control mt-3" placeholder="Email Address *">
	            			<input type="text" name="phone" class="form-control mt-3" placeholder="Phone Number">
	            		</div>
	            		<div class="col-sm-6">
	            			<input type="text" name="business_name" class="form-control" placeholder="Business Name">
	            			<input type="text" name="type" class="form-control mt-3" placeholder="Type Of Request: Real Estate, Commercial, etc.">
	            			<input type="text" name="date" class="form-control mt-3" placeholder="Date(s) Of Photo Shoot">
	            		</div>
	            		<div class="col-sm-12">
	            			<input type="text" name="location" class="form-control mt-3" placeholder="123 Main St. Bangor ME 04401">
	            		</div>
	            	</div>
            		
            		
            		<span class="text-danger" style="font-size: 8pt;">* Required</span>
            		<button type="submit" class="btn btn-block btn-success mt-3"><i class="far fa-paper-plane"></i> Send Contact Request</button>
            	{{ Form::close() }}
            </div>
        </div>
    </div>
</section>