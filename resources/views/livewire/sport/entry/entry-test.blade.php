<div class="bg-green-500">
    <span class="text-gray-700">{{ __('Select Users') }}</span>
    <div>
        <div class="bg-red-400 py-6" id="users-select" wire:ignore></div>
    </div>



    {{-- {{ $tagjson }}

    {{ $testini }} --}}

    <?php echo "<script>let tagtest = $tagjson;</script>"; ?>

    <?php echo "<script>let tagtest2 = $tags;</script>"; ?>

    <span id="document_target" style="display: none;"><?= $tags ?></span>

    <script>
        let myOptions = <?php echo $tags; ?>;

        let testing = document.getElementById("document_target").textContent;

        console.log('A', tagtest);

        console.log('B', myOptions);

        console.log('C', tagtest2);

        /* let myOptions = [{
                label: "a",
                value: "1"
            },
            {
                label: "b",
                value: "2"
            },
            {
                label: "c",
                value: "3"
            }
        ]; */
        VirtualSelect.init({
            ele: '#users-select',
            options: myOptions,
            multiple: true,
            search: true,
            placeholder: "{{ __('Select Picked Orders') }}",
            noOptionsText: "{{ __('No results found') }}",
        });

        let selectedUsers = document.querySelector('#users-select')
        selectedUsers.addEventListener('change', () => {
            let data = selectedUsers.value
            @this.set('selectedUsers', data)
        })
    </script>

</div>
