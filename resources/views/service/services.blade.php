<style>
    .btn {
        color: white;
        background-color: #3592f5;
        border: rounded;
        padding: 5px;
        margin: 5px;
    }
</style>

<div class="container ">
    <div class="card">
        <h2> Services page</h2>
        <div class="mx-auto">
            <a href="#" class="btn btn primary"> add new service</a>
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
                        <th> Purchase note </th>
                        <th> Meta title </th>
                        <th> Meta description </th>
                        <th> sell button text </th>
                        <th> Downloadable </th>
                        <th> Sale start date </th>
                        <th> Sale end date </th>
                        <th> Publish at </th>
                        <th> Deleted at </th>
                        <th> Suspended at </th>
                    </tr>
                    @foreach ($services as $item)
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
                        <td> {{ $item->purchase_note}} </td>
                        <td> {{ $item->meta_title}} </td>
                        <td> {{ $item->meta_description}} </td>
                        <td> {{ $item->sell_button_text}} </td>
                        <td> {{ $item->downloadable}} }}</td>
                        <td> {{ $item->sale_start_date }}</td>
                        <td> {{ $item->sale_end_date}} </td>
                        <td> {{ $item->publish_at}} </td>
                        <td> {{ $item->deleted_at}} </td>
                        <td> {{ $item->suspended_at}} </td>
                        <td>
                            <a href="{{route('service.show', ($item->id))}}" class="btn btn-sm btn-primary">View</a>
                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{route('service.destroy', ($item->id))}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
</div>