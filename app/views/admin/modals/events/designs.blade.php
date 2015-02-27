<div class="modal" id="modal-design" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Designs</h4>
            </div>

            <form role="form" id="form-add" class="form-horizontal">
            <div class="modal-body">
                <div class="row text-center">
                    <a href="/add/design" class="btn btn btn-primary">Add new design!</a>
                </div><br>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                  <div class="carousel-inner" role="listbox">
                    @foreach(Design::where('deleted_at','=',null)->get() as $key => $value)
                      <div class="item @if($key === 0){{'active'}} @endif">
                        <object data="{{ $value->design_path }}" type="image/svg+xml">
                        </object>

                        <div class="carousel-caption">
                          <span class="design-name">{{ $value->design_name }}</span><br>
                          <span>

                            <input type="hidden" name="design_name" value="{{ $value->design_name }}">
                            <input type="hidden" name="design_id" value="{{ $value->id }}">
                            <button type="button" class="btn btn-primary select-design">Select</button>
                          </span>
                        </div>
                      </div>
                    @endforeach

                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}

            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function(){
        modalOpen = '';
        $('.carousel').carousel({
          interval: false
        });
        $('.select-design').click(function(){
          id = $(this).parent().find('[name=design_id]').val();
          design_name = $(this).parent().find('[name=design_name]').val();
          $('#'+modalOpen).find('[name=design_id]').val(id);
          $('#'+modalOpen).find('.design-name').html(design_name);
          $('#modal-design').modal('hide');
        });

        $('.modal').on('shown.bs.modal', function () {
          if($(this).attr('id') == "modal-edit" || $(this).attr('id') == 'modal-add')
            modalOpen = $(this).attr('id');
            console.log(modalOpen);
        });

    })
</script>