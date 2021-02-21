<style>
    .btn {
        color: white;
        background-color: #3592f5;
        border: rounded;
        padding: 5px;
        margin: 10px;
    }
</style>

<div class="container ">
    <div class="card">
        <h2> View Product page</h2>
        <div class="mx-auto">
            <a href="{{route('product.index')}}" class="btn btn-primary btn-sm"> < Back to Products page</a> <div>
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
                        <tr>
                            <td> {{ $product->id}}</td>
                            <td> {{ $product->name}}</td>
                            <td> {{ $product->status}}</td>
                            <td> {{ $product->visibility}}</td>
                            <td> {{ $product->type}}</td>
                            <td> {{ $product->sKU}}</td>
                            <td> {{ $product->regular_price}} </td>}}
                            <td> {{ $product->description}}</td>
                            <td> {{ $product->summary}}</td>
                            <td> {{ $product->sale_price}}</td>
                            <td> {{ $product->taxable}} </td>
                            <td> {{ $product->weigh}}t}} </td>
                            <td> {{ $product->length}} </td>
                            <td> {{ $product->width}} </td>
                            <td> {{ $product->height}} </td>
                            <td> {{ $product->purchase_note}} </td>
                            <td> {{ $product->meta_title}} </td>
                            <td> {{ $product->meta_description}} </td>
                            <td> {{ $product->sell_button_text}} </td>
                            <td> {{ $product->virtual}} </td>
                            <td> {{ $product->downloadable}} }}</td>
                            <td> {{ $product->sale_start_date }}</td>
                            <td> {{ $product->sale_end_date}} </td>
                            <td> {{ $product->publish_at}} </td>
                            <td> {{ $product->deleted_at}} </td>
                            <td> {{ $product->suspended_at}} </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>                       
                </table>
            </div>

        </div>
    </div>
</div>