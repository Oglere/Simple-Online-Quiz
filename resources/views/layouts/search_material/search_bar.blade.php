<form id="searchForm" action="/results" method="GET">
    @csrf
    <div class="search">
        <input 
            id="srch" 
            style="padding-left: 10px;" 
            name="search" 
            type="text" 
            placeholder="Search..." 
            value="{{ old('search', request()->input('search')) }}"
        >
        <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
        </button>
    </div>

    <div class="date">
        <input 
            type="number" 
            id="from-year" 
            name="from-year" 
            min="1900" 
            max="2100" 
            step="1" 
            placeholder="From Year" 
            value="{{ old('from-year', request()->input('from-year')) }}"
        >
        <label for="to-year">-</label>
        <input 
            type="number" 
            id="to-year" 
            name="to-year" 
            min="1900" 
            max="2100" 
            step="1" 
            placeholder="To Year" 
            value="{{ old('to-year', request()->input('to-year')) }}"
        >

        <div class="righttag">
            <p style="margin-bottom: 10px; margin-top: 20px; font-weight: bold;">Looking for?</p>
            @php
                $documentTypes = ['Case Study', 'Thesis', 'Proposal', 'Capstone', 'System Studies'];
                $selectedTypes = request()->input('document_types', []);
            @endphp

            @foreach ($documentTypes as $type)
                <div class="chkbx" style="{{ in_array($type, $selectedTypes) ? 'background-color: rgb(142, 4, 4);' : '' }}">
                    <input 
                        class="w3-check" 
                        type="checkbox" 
                        name="document_types[]" 
                        value="{{ $type }}" 
                        {{ in_array($type, $selectedTypes) ? 'checked' : '' }}
                    >
                    <label class="tada" style="{{ in_array($type, $selectedTypes) ? 'color: white;' : '' }}">
                        {{ $type }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</form>


<script>
document.getElementById('searchForm').addEventListener('submit', function(e) {
    const searchInput = document.getElementById('srch').value.trim();
    const fromYear = document.getElementById('from-year').value.trim();
    const toYear = document.getElementById('to-year').value.trim();
    const checkboxes = document.querySelectorAll('input[name="document_types[]"]:checked');

    // Validate that at least one input is filled
    if (!searchInput && !fromYear && !toYear && checkboxes.length === 0) {
        alert('Please fill at least one field to search.');
        e.preventDefault(); // Prevent form submission
    }
});

const checkboxes = document.querySelectorAll('.chkbx');
checkboxes.forEach(chkbx => {
    chkbx.addEventListener('click', (e) => {
        if (e.target.tagName !== 'INPUT') {
            const checkbox = chkbx.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
        }
        const checkbox = chkbx.querySelector('input[type="checkbox"]');
        chkbx.style.backgroundColor = checkbox.checked ? '#8e0404' : ''; 
        const label = chkbx.querySelector('label'); 
        label.style.color = checkbox.checked ? 'white' : ''; 
    });
});
</script>
