<div class="card-body">
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Tagihan</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $bill->name }}</td>
                <td>{{ idr($bill->nominal) }}</td>
                <td>
                    @if (array_sum($payments->pluck('pay')->toArray()) === $bill->nominal)
                        <span class="badge badge-success" style="font-size: 11px; padding: 3px 8px">Lunas</span>
                    @else
                        <span class="badge badge-danger" style="font-size: 11px; padding: 3px 8px">Tunggak</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-info btn-sm" role="button" data-toggle="collapse"
                        data-target="#table-detail">
                        <i class="fa fa-eye"></i>
                    </button>
                    <a href="#" target="_blank" class="btn btn-dark btn-sm {{array_sum($payments->pluck('pay')->toArray()) > 0 ? '' : 'disabled' }}"
                    >
                        <i class="fa fa-print"></i>
                    </a>
                    <button wire:click.prevent='pay' class="btn btn-sm btn-success"
                        {{$bill->nominal == array_sum($payments->pluck('pay')->toArray()) ? 'disabled' : ''}}
                    >
                        <i class="far fa-money-bill-alt"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="hiddenRow">
                    <div class="collapse" id="table-detail" wire:ignore.self>
                        <table class="table table-striped table-inner">
                            <thead class="thead-dark">
                                <tr class="info">
                                    <th>Kode Transaksi</th>
                                    <th>Dibayar</th>
                                    <th>Tanggal Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->code }}</td>
                                        <td>{{ idr($payment->pay) }}</td>
                                        <td>{{ format_date($payment->pay_date) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" align="center">Tidak ada transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($payments->isNotEmpty())
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th>{{ idr(array_sum($payments->pluck('pay')->toArray())) }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>