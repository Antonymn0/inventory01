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
        <h2> View Service page</h2>
        <div class="mx-auto">
            <a href="{{route('service.index')}}" class="btn btn-primary btn-sm">
                < Back to services page</a>
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
                <tr>
                    <td> {{ $service->id}}</td>
                    <td> {{ $service->name}}</td>
                    <td> {{ $service->status}}</td>
                    <td> {{ $service->visibility}}</td>
                    <td> {{ $service->type}}</td>
                    <td> {{ $service->sKU}}</td>
                    <td> {{ $service->regular_price}} </td>}}
                    <td> {{ $service->description}}</td>
                    <td> {{ $service->summary}}</td>
                    <td> {{ $service->sale_price}}</td>
                    <td> {{ $service->taxable}} </td>
                    <td> {{ $service->purchase_note}} </td>
                    <td> {{ $service->meta_title}} </td>
                    <td> {{ $service->meta_description}} </td>
                    <td> {{ $service->sell_button_text}} </td>
                    <td> {{ $service->downloadable}} }}</td>
                    <td> {{ $service->sale_start_date }}</td>
                    <td> {{ $service->sale_end_date}} </td>
                    <td> {{ $service->publish_at}} </td>
                    <td> {{ $service->deleted_at}} </td>
                    <td> {{ $service->suspended_at}} </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</div>
</div>