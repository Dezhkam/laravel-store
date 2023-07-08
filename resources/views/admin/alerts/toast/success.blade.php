
@if (session('toast-success'))
    <section class="toast" data-delay="5000" >
        <section class="toast-body py-3 d-flex bg-success text-white">
            <strong class="ml-auto">
                {{ session('toast-success') }}
            </strong>
        </section>
        <button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close" >
            <span aria-hidden="true">&times;</span>
        </button>
    </section>   
    <script>
        $(document).ready(function (){
            $('.toast').toast('show');
        })
    </script> 
@endif