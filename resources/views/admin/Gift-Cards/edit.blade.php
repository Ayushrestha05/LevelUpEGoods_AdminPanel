@extends('layouts.admin')

@section('content')
<div class="float-right mr-3 mt-2">
    <a href="{{ route('admin.gift-card.index') }}"><h5><b>&lt; Back</h5></b></a>
</div>
<div class="col mt-1 d-flex flex-column">
    
    @if ($errors->any())
    <div class="alert alert-danger m-2">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.gift-card.update',$item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Edit Existing Gift Card</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Gift Card Description</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="album_name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Card's Name" value="{{ $item->item_name }}">
                    </div>
                    <div class="form-group">
                        <label for="album_artist">Description</label>
                        {{-- <input type="text" class="form-control" name="description" placeholder="Enter Card's Description"> --}}
                        <textarea class='form-control' name="description_text" rows="3" placeholder="Enter Card's Description">{{ $item->item_description }}</textarea>
                    </div>
                    <div class="input-group d-flex flex-column">
                        <label>Card Image</label>
                        <div class="custom-file w-100 mb-3">
                            <input type="file" class="custom-file-input" id="image" name='image' onchange="loadFile(event)">
                            <label class="custom-file-label" for="image" id='labelvalue'>{{ $item->item_image }}</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Card Contents</h3>
                </div>
                <div class="card-body d-flex flex-column" id="album_content">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Card Type</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        {{-- @foreach ($gift_card as $card)
                            <tr>
                                <td><input type="text" class="form-control" name="card[0][type]" placeholder="Enter Card Type" value="{{ $card->card_type }}"></td>
                                <td><input type="text" class="form-control" name="card[0][price]" placeholder="Enter Card Price" value="{{ $card->card_price }}"></td>
                                <td><button type="button" class="btn btn-danger remove-input-field">Delete</button></td>
                            </tr>
                        @endforeach --}}
                        @for ($i=0;$i<count($gift_card);$i++)
                        <tr>
                            <td><input type="text" class="form-control" name="card[{{ $i }}][type]" placeholder="Enter Card Type" value="{{ $gift_card[$i]->card_type }}" disabled></td>
                            <td><input type="text" class="form-control" name="card[{{ $i }}][price]" placeholder="Enter Card Price" value="{{ $gift_card[$i]->card_price }}"></td>
                            @if ($i == count($gift_card)-1)
                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-primary"><i class="right fas fa-plus mr-2"></i>Add Card Type</button></td>
                            @endif
                        </tr>
                        @endfor
                    </table>
                </div>
            </div>
            
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
        </div>   
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = count($illustration_prices);
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" class="form-control" name="card['+i+'][type]" placeholder="Enter Card Type"></td><td><input type="text" class="form-control" name="card['+i+'][price]" placeholder="Enter Card Price"></td><td><button type="button" class="btn btn-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection