@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
  <div class="row">

    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>Category List</h2>
            <div class="clearfix"></div>
        </div>
        <div>
          <div class="x_content">
            <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr>
                    <th>SL No.</th>
                    <th>Slot Number</th>
                    <th>Number</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody class="form-text-element">
                  @if (isset($slots) && !empty($slots))
                    @php
                        $count = 1;
                    @endphp
                      @foreach ($slots as $item)
                        <tr>
                          <td>{{$count++}}</td>
                          <td>{{$item->slot_no}}</td>
                          <td>{{$item->number}}</td>
                          <td>
                          <a class="btn btn-warning" href="{{route('admin.slot_edit',['slot_id'=>$item->id])}}">Edit</a>
                          <a class="btn btn-danger" href="{{route('admin.slot_delete',['slot_id'=>$item->id])}}">Delete</a>
                          </td>
                        </tr>
                      @endforeach
                  @endif
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="x_panel">
          <div class="x_title">
              <h2>Add Product</h2>
              <div class="clearfix"></div>
          </div>
            <div>
                @if (Session::has('message'))
                    <div class="alert alert-success" >{{ Session::get('message') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" >{{ Session::get('error') }}</div>
                @endif
            </div>
          <div>
              <div class="x_content">
                {{ Form::open(['method' => 'post','route'=>'admin.slot_insert']) }}
                    <div class="well" style="overflow: auto">
                      <center><h3>Pre Defined Solts And Numbers</h3></center>
                      <div class="form-row mb-10">
                        <div class="form-group" id="size-div">
                          <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                            <div class="form-row">
                                <label class="col-sm-12 control-label">Numbers</label>
                                <div class="col-sm-2" style="width:150px;">
                                    <input type="text" name="slot[]" id="swidth" class="form-control" placeholder="Slot Number" required="">
                                </div>

                                <div class="col-sm-2" style="width:150px;">
                                    <input type="text" name="numbers[]" id="sheigth" class="form-control" placeholder="Number" required="">
                                </div>
                            </div>    
                          <button type="button" class="btn btn-info" id="addsize" name="addsize" onclick="addMoreSlot()">+ Add More</button> 
                          </div>
                        </div>
                    </div>
                    </div>                  
                    <div class="form-group">    	            	
                        {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}  
                    </div>
                {{ Form::close() }}
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
 @endsection

 @section('script')
     <script>
       var count = 1;
       function addMoreSlot() {
        var html = '<div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="slotdiv'+count+'">'+
          '<div class="form-row">'+
            '<label class="col-sm-12 control-label">Numbers</label>'+
            '<div class="col-sm-2" style="width:150px;">'+
               ' <input type="text" name="slot[]" id="swidth" class="form-control" placeholder="Slot Number" required="">'+
            '</div>'+

            '<div class="col-sm-2" style="width:150px;">'+
               ' <input type="text" name="numbers[]" id="sheigth" class="form-control" placeholder="Number" required="">'+
            '</div>'+
            '</div>    '+
            '<button type="button" class="btn btn-danger" id="addsize" name="addsize" onclick="removeSlot('+count+')">+ Remove </button> '+
          '</div>';
          $("#size-div").append(html);
          count++;
       }

       function removeSlot(id) {
         $("#slotdiv"+id).remove();
       }
     </script>
 @endsection