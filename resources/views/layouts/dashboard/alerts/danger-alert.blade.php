@if ($errors->any())
<div class="alert bg-white alert-danger" role="alert">
    <div class="iq-alert-icon">
       <i class="ri-information-line"></i>
    </div>
    <div class="iq-alert-text">
        <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
                <li></li>{{$error}}
        </ul>
            @endforeach
    </div>
    <botton type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="ri-close-line"></i>
    </botton>
 </div>
 @endif