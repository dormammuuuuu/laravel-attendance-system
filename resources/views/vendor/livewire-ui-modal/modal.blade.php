<div>
    @isset($jsPath)
        <script>{!! file_get_contents($jsPath) !!}</script>
    @endisset
    @isset($cssPath)
        <style>{!! file_get_contents($cssPath) !!}</style>
    @endisset

    <div 
        x-data="LivewireUIModal()"
        x-init="init()"
        x-on:close.stop="setShowPropertyTo(false)"
        x-on:keydown.escape.window="closeModalOnEscape()"
        x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
        x-show="show"
        class="modal-parent" style="display: none;">
        <div class="modal-dialog">
            <div x-show="show" class="modal-ukdiv-parent">
                <div class="modal-ukdiv">
                </div>
            </div>

            <span class="modal-span" aria-hidden="true">&#8203;</span>

            <div x-show="show && showActiveComponent" x-transition:enter="ease-out duration-300"
                class="modal-last-div"
                id="modal-container">
                @forelse($components as $id => $component)
                <div x-show.immediate="activeComponent == '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}">
                    <button class="close-button" wire:click="$emit('closeModal')"><i class='bx bx-x'></i></button>

                    @livewire($component['name'], $component['attributes'], key($id))
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>