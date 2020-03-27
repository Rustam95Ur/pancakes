<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                @if ($message = Session::get('success'))
                    <h6 class="text-center text-success">{!! $message !!}</h6>
                @endif
                @if ($message = Session::get('error'))
                    <h6 class="text-center text-danger">{!! $message !!}</h6>
                @endif
                @if ($message = Session::get('warning'))
                    <h6 class="text-center text-danger">{!! $message !!}</h6>
                @endif
                @if ($message = Session::get('info'))
                    <h6 class="text-center text-danger">{!! $message !!}</h6>
                @endif
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <ul class="questions">
                            <li class="text-danger"><h6>{!! $error !!}</h6></li>
                        </ul>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
