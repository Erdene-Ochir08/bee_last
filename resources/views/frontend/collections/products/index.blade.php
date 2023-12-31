@extends('layouts.app')

@section('content')

    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Бүтээгдэхүүн</h4>
                </div>

                <livewire:frontend.product.index :category="$category"/>

            </div>
        </div>
    </div>

@endsection
