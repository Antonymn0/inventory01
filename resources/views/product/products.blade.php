<style>
    .btn{
    color:white;
    background-color:#3592f5;
    border:rounded;
    padding: 5px;
    margin: 10px;
    }

</style>

<div class="container ">
    <div class="card">
        <h2> Products page</h2>
        <div class="mx-auto">
            <a href="{{route('add.new.product')}}" class="btn btn primary"> add new product</a>
            <div>
                <table class=" table table-responsive table-sm table-stripped">
                    <tr>
                        <th> ID</th>
                        <th> Name</th>
                        <th> Status</th>
                        <th> Visibility</th>
                        <th> Type</th>
                        <th> SKU</th>
                        <th> Regular price </th>
                        <th> Describtion</th>
                        <th> Summary</th>
                        <th> Sale price</th>
                        <th> Taxable </th>
                        <th> Weight </th>
                        <th> Length </th>
                        <th> Width </th>
                        <th> Height </th>
                        <th> Purchase note </th>
                        <th> Meta title </th>
                        <th> Meta description </th>
                        <th> sell button text </th>
                        <th> Virtual </th>
                        <th> Downloadable </th>
                        <th> Sale start date </th>
                        <th> Sale end date </th>
                        <th> Publish at </th>
                        <th> Deleted at </th>
                        <th> Suspended at </th>
                    </tr>
                    @if ($products ->count() < 1 )
                     <tr>
                        <td colspan=7>
                            <p class="text-muted text-center p-2"> No records to show </p>
                        </td>
                     </tr>                    
                    @else
                    @foreach ($products as $item)
                        <tr>     
                            <td> {{ $item->id}}</td>
                            <td> {{ $item->name}}</td>
                            <td> {{ $item->status}}</td>
                            <td> {{ $item->visibility}}</td>
                            <td> {{ $item->type}}</td>
                            <td> {{ $item->sKU}}</td>
                            <td> {{ $item->regular_price}} </td>}}
                            <td> {{ $item->description}}</td>
                            <td> {{ $item->summary}}</td>
                            <td> {{ $item->sale_price}}</td>
                            <td> {{ $item->taxable}} </td>
                            <td> {{ $item->weigh}}t}} </td>
                            <td> {{ $item->length}} </td>
                            <td> {{ $item->width}} </td>
                            <td> {{ $item->height}} </td>
                            <td> {{ $item->purchase_note}} </td>
                            <td> {{ $item->meta_title}} </td>
                            <td> {{ $item->meta_description}} </td>
                            <td> {{ $item->sell_button_text}} </td>
                            <td> {{ $item->virtual}} </td>
                            <td> {{ $item->downloadable}} }}</td>
                            <td> {{ $item->sale_start_date }}</td>
                            <td> {{ $item->sale_end_date}} </td>
                            <td> {{ $item->publish_at}} </td>
                            <td> {{ $item->deleted_at}} </td>
                            <td> {{ $item->suspended_at}} </td>
                            <td>
                                <a href="{{route('product.show', ($item->id))}}" class="btn btn-sm btn-primary">View</a>
                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{route('product.destroy', ($item->id))}}" method="POST">
                                    @csrf
                                    @method('DELETE') 
                                    <input type="submit" name="submit" value="Delete">                           
                                </form>
                            </td>
                        </tr>
                    @endforeach    
                    @endif
                </table>
            </div>

        </div>
    </div>
</div>