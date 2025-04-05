<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pedidos pendientes') }}
        </h2>
    </x-slot>

    <div x-data="kitchen">
        {{-- Pedidos pendientes --}}
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-gray-900 dark:text-gray-100">
                        <div class="space-y-2">
                            <div class="grid grid-cols-5 font-bold">
                                <div>Descripción</div>
                                <div class="text-center">Notas</div>
                                <div class="text-center">Cantidad</div>
                                <div class="text-center">Mesa</div>
                                <div class="text-center">Acciones</div>
                            </div>
                            <template x-for="order in pendingOrders" :key="order.id">
                                <div class="grid grid-cols-5">
                                    <div x-text="order.menu_entry.name"></div>
                                    <div class="text-center" x-text="order.notes"></div>
                                    <div class="text-center" x-text="order.quantity"></div>
                                    <div class="text-center" x-text="order.table.name"></div>
                                    <div class="text-center">
                                        <button @click="updateOrderToPreparing(order)"
                                                class="bg-blue-950 text-white px-5 rounded">Preparar
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Ordenes en preparación--}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-bold text-lg dark:text-white">Ordenes en preparación</h2>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-gray-900 dark:text-gray-100">
                        <div class="space-y-2">
                            <div class="grid grid-cols-5 font-bold">
                                <div>Descripción</div>
                                <div class="text-center">Notas</div>
                                <div class="text-center">Cantidad</div>
                                <div class="text-center">Mesa</div>
                                <div class="text-center">Acciones</div>
                            </div>
                            <template x-for="order in inProgressOrders" :key="order.id">
                                <div class="grid grid-cols-5">
                                    <div x-text="order.menu_entry.name"></div>
                                    <div class="text-center" x-text="order.notes"></div>
                                    <div class="text-center" x-text="order.quantity"></div>
                                    <div class="text-center" x-text="order.table.name"></div>
                                    <div class="text-center">
                                        <button @click="updateOrderToCompleted(order)"
                                                class="bg-blue-950 text-white px-5 rounded">Listo
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Últimos pedidos atendidos--}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-bold text-lg dark:text-white">Últimos pedidos atendidos</h2>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-gray-900 dark:text-gray-100">
                        <div class="space-y-2">
                            <div class="grid grid-cols-5 font-bold">
                                <div>Descripción</div>
                                <div class="text-center">Notas</div>
                                <div class="text-center">Cantidad</div>
                                <div class="text-center">Mesa</div>
                                <div class="text-center"></div>
                            </div>
                            <template x-for="order in completedOrders" :key="order.id">
                                <div class="grid grid-cols-5">
                                    <div x-text="order.menu_entry.name"></div>
                                    <div x-text="order.notes" class="text-center"></div>
                                    <div x-text="order.quantity" class="text-center"></div>
                                    <div x-text="order.table.name" class="text-center"></div>
                                    <div class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-green-500"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('kitchen', () => ({

                init() {
                    setInterval(() => {
                        axios.get('/orders/kitchen')
                            .then(response => {
                                this.pendingOrders = response.data;
                            });
                    }, 3000);
                },

                pendingOrders: {!! $pendingOrders->toJson() !!},
                inProgressOrders: {!! $inProgressOrders->toJson() !!},
                completedOrders: {!! $completedOrders->toJson() !!},
                orderStatus: {!! json_encode($orderStatus) !!},

                updateOrderToPreparing(order) {
                    this.updateStatusOrder(order, {status: this.orderStatus.in_progress})
                        .then(response => {
                            let index = this.pendingOrders.findIndex(pendingOrder => pendingOrder.id === order.id);
                            this.pendingOrders.splice(index, 1);
                            this.inProgressOrders.push(response.data);
                        })
                }
                ,

                updateOrderToCompleted(order) {
                    this.updateStatusOrder(order, {status: this.orderStatus.completed})
                        .then(response => {
                            let index = this.inProgressOrders.findIndex(inProgressOrder => inProgressOrder.id === order.id);
                            this.inProgressOrders.splice(index, 1);
                            this.completedOrders.push(response.data);
                        })
                }
                ,

                updateStatusOrder(order, data) {
                    return axios.put('/update-orders-status/' + order.id, data)
                }
            }));
        });
    </script>
</x-app-layout>
