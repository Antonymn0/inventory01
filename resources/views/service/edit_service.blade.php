<style>
    div {
        padding: 5px;
        margin: 2px;
    }

    input,
    label {
        padding: 8px;
    }

    .btn {
        color: white;
        background-color: #3592f5;
        border: rounded;
        padding: 5px;
        margin: 5px;
        margin: auto;
    }
</style>

<div>
    <h2> Edit Service form </h2>
    <a href="{{route('service.index')}}" class="btn btn-primary btn-sm">
        < Back to Services page </a>

         @include('inc/messages')

         <form action="{{route('service.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name"> Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$service->name}}">
            </div>
            <div>
                <label for="slug"> slug</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{$service->slug}}">
            </div>
            <div>
                <label for="status"> status</label>
                <input type="text" id="status" name="status" class="form-control" value="{{$service->status}}">
            </div>
            <div>
                <label for="visivility"> visibility</label>
                <input type="text" id="visibility" name="visibility" class="form-control"
                    value="{{$service->visibility}}">
            </div>
            <div>
                <label for="type"> type</label>
                <input type="text" id="type" name="type" class="form-control" value="{{$service->type}}">
            </div>


            <div>
                <label for="sku"> sku</label>
                <input type="text" id="sku" name="sku" class="form-control" value="{{$service->sku}}">
            </div>
            <div>
                <label for="regular_price"> Regular price</label>
                <input type="text" id="regular_price" name="regular_price" class="form-control"
                    value="{{$service->regular_price}}">
            </div>
            <div>
                <label for="description"> description</label>
                <input type="text" id="description" name="description" class="form-control"
                    value="{{$service->description}}">
            </div>


            <div>
                <label for="summary"> Summary</label>
                <input type="text" id="summary" name="summary" class="form-control" value="{{$service->summary}}">
            </div>
            <div>
                <label for="sale_price"> sale_price</label>
                <input type="text" id="sale_price" name="sale_price" class="form-control"
                    value="{{$service->sale_price}}">
            </div>
            <div>
                <label for="taxable"> taxable</label>
                <input type="text" id="taxable" name="taxable" class="form-control" value="{{$service->taxable}}">
            </div>
           
            <div>
                <label for="purchase_note"> purchase_note</label>
                <input type="text" id="purchase_note" name="purchase_note" class="form-control"
                    value="{{$service->purchase_note}}">
            </div>
            <div>
                <label for="meta_title"> meta_title</label>
                <input type="text" id="meta_title" name="meta_title" class="form-control"
                    value="{{$service->meta_title}}">
            </div>
            <div>
                <label for="meta_description"> meta_description</label>
                <input type="text" id="meta_description" name="meta_description" class="form-control"
                    value="{{$service->meta_description}}">
            </div>
            <div>
                <label for="sell_button_text"> sell_button_text</label>
                <input type="text" id="sell_button_text" name="sell_button_text" class="form-control"
                    value="{{$service->sell_button_text}}">
            </div>

           
            <div>
                <label for="downloadable"> downloadable</label>
                <input type="text" id="downloadable" name="downloadable" class="form-control"
                    value="{{$service->downloadable}">
            </div>
            <div>
                <label for="sale_start_date"> sale_start_date</label>
                <input type="date" id="sale_start_date" name="sale_start_date" class="form-control" value="{{$service->sale_start_date}}">
            </div>
            <div>
                <label for="sale_end_date"> sale_end_date</label>
                <input type="date" id="sale_end_date" name="sale_end_date" class="form-control"
                    value="{{$service->sale_end_date}}">
            </div>


            <div>
                <label for="publish_at"> publish_at</label>
                <input type="date" id="publish_at" name="publish_at" class="form-control"
                    value="{{$service->published_at}}">
            </div>
            <div>
                <label for="deleted-at"> deleted-at</label>
                <input type="date" id="deleted-at" name="deleted-at" class="form-control"
                    value="{{$service->deleted_at}}">
            </div>
            <div>
                <label for="suspended_at"> suspended_at</label>
                <input type="date" id="suspended_at" name="suspended_at" class="form-control"
                    value="{{$service->suspended_at}}">
            </div>


            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary btn-sm">
            </form>
</div>