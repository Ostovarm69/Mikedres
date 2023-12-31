@if ($product->sizeGuide)
    <div class="modal fade text-left" id="size-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">راهنمای سایز بندی</h4>

                    <h5 class="modal-title"></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body text-right">
                    @foreach(json_decode($product->sizeGuide->sizes, true) as $item)
                        <div class="col-mb-12">{!! $item['title'] !!}</div>
                        <div class="table-responsive">
                            <table class="table text-center table-sized-guide">
                                @php
                                    $chart = json_decode($item['chart'], true);
                                    $emptyRows = [];
                                @endphp
                                <tr>
                                    @foreach($chart[1] as $index => $it)
                                        @if(!empty(trim($it)))
                                            <th scope="col">
                                                {{ $chart[0][$index] }}
                                            </th>
                                        @endif
                                    @endforeach
                                </tr>
                                <tr>
                                @foreach($chart[1] as $itemTitle)
                                        @if(!empty(trim($itemTitle)))
                                            <td>
                                                {{$itemTitle}}
                                            </td>
                                        @endif
                                @endforeach
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@elseif($product->sizeType)
    <div class="modal fade text-left" id="size-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">راهنمای سایز بندی</h4>

                    <h5 class="modal-title"></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body text-right">

                    <div class="col-mb-12">{!! $product->sizeType->description !!}</div>
                    <div class="col-mb-6">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    @foreach ($product->sizeType->sizes as $size)
                                        @if ($product->sizes()->where('size_id', $size->id)->where('value', '!=', '')->count())
                                            <th scope="col">{{ $size->title }}</th>
                                        @endif
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($product->sizes->groupBy('pivot.group') as $sizes)
                                    <tr>
                                        @foreach ($product->sizetype->sizes as $size)

                                            @php
                                                $group = $sizes->first()->pivot->group;
                                                $value = $product->sizes()->where('size_id', $size->id)->where('group', $group)->first()->pivot->value ?? '';
                                            @endphp

                                            @if ($product->sizes()->where('size_id', $size->id)->where('value', '!=', '')->count())
                                                <td>{{ $value }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
