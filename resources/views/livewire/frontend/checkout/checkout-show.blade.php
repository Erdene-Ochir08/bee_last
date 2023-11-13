<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Тооцооны хэсэг</h4>
            <hr>

            @if ($totalAmount != '0')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Нийт Дүн :
                                <span class="float-end">{{ $totalAmount }} төг</span>
                            </h4>

                            <hr>
                            <small>* Дансруу төлбөрөө шилжүүлэхдээ дансны нэрийг нягтлана уу!!</small>
                            <br />
                            <small>* Шилжүүлснээс 3-н цагийн дотор төлбөрийг шалгана</small>
                            <br />
                            <small>* Хаяг болон утасны дугаар оруулах хэсгийг нягтлан оруулна уу!!</small>
                            <br />
                            <small>* Гүйлгээний утган дээр бичих тоог алдалгүй зөв бичих!!</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Захиалагчийн мэдээлэл
                            </h4>
                            <hr>

                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Захиалагчийн нэр</label>
                                        <input type="text" wire:model.defer="fullname" class="form-control"
                                               placeholder="Enter Full Name" />
                                        @error('fullname')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Утасны дугаар</label>
                                        <input type="number" wire:model.defer="phone" class="form-control"
                                               placeholder="Enter Phone Number" />
                                        @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Email</label>
                                        <input type="email" wire:model.defer="email" class="form-control"
                                               placeholder="Enter Email Address" />
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Гэрийн хаяг</label>
                                        <textarea wire:model.defer="address" class="form-control" rows="2"></textarea>
                                        @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
{{--                                        <label>Select Payment Mode: </label>--}}
                                        <div class="d-md-flex align-items-start">
{{--                                            <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab"--}}
{{--                                                 role="tablist" aria-orientation="vertical">--}}
{{--                                                <button wire:loading.attr="disabled" class="nav-link active fw-bold" id="cashOnDeliveryTab-tab"--}}
{{--                                                        data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab"--}}
{{--                                                        type="button" role="tab" aria-controls="cashOnDeliveryTab"--}}
{{--                                                        aria-selected="true">Шилжүүлгээр төлөх</button>--}}
{{--                                                <button wire:loading.attr="disabled" class="nav-link fw-bold" id="onlinePayment-tab"--}}
{{--                                                        data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button"--}}
{{--                                                        role="tab" aria-controls="onlinePayment"--}}
{{--                                                        aria-selected="false">internetbank аар төлөх</button>--}}
{{--                                            </div>--}}
                                            <div class="tab-content col-md-9" id="v-pills-tabContent">
                                                <div class="tab-pane active show fade" id="cashOnDeliveryTab"
                                                     role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab"
                                                     tabindex="0">
                                                    <h6>Данс хаан банк: {{$client->account_number}}  ( {{$client->account_name}} ) -> Шилжүүлэх дүн: {{$totalAmount}} төг -> гүйлгээний утга: {{$uniqueNumber}}</h6>
                                                    <hr />
                                                    <button type="button" wire:loading.attr="disabled" wire:click="codOrder" class="btn btn-primary">
                                                        <span wire:loading.remove wire:target="codOrder">
                                                            Шилжүүлсэн бол дарна уу!
                                                        </span>
                                                    </button>

                                                </div>


                                                <div class="tab-pane fade" id="onlinePayment" role="tabpanel"
                                                     aria-labelledby="onlinePayment-tab" tabindex="0">
                                                    <h6>internetbank аар төлөх</h6>
                                                    <hr />
                                                    <button type="button" wire:loading.attr="disabled" wire:click="codOrderBank" class="btn btn-warning">internetbank аар төлөх</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            @else
                <div class="card card-body shadow text-center p-md-5">
                    <h4>Төлөлт хийх бараа байхгүй байна, та бараагаа сагслаад төлөлтөө хийгээрэй</h4>
                    <a href="{{ url('collections') }}" class="btn btn-warning">Shop now</a>
                </div>
            @endif
        </div>
    </div>
</div>
