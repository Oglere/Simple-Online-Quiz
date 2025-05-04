<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    echo "<script> window.location.assign('../') </script>";
}
?>

<div class="contents">
    <p>D A R A</p>
    <h4>Digital Academic Repository and Archive</h4>
    <form id="searchForm" action="/results" method="get">
        @csrf
        <div class="search">
            <input id="search" name="search" type="text" placeholder="Search...">
            <button type="submit">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-search"
                >
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
            </button>
        </div>

        <div class="tags">
            <div class="tag">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-tag"
                >
                    <path
                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"
                    />
                    <line x1="7" y1="7" x2="7.01" y2="7" />
                </svg>
                
                <div class="tagform">
                    <div class="lefttag">
                        <div class="date">
                            <input type="number" id="from-year" name="from-year" min="1900" max="2100" step="1" placeholder="From Year">
                            <label for="to-year">-</label>
                            <input type="number" id="to-year" name="to-year" min="1900" max="2100" step="1" placeholder="To Year">
                        </div>
                    </div>
                    <div class="midtag"></div>
                    <div class="righttag">
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="Case Study">
                            <label class="tada">Case Study</label> 
                        </div>
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="Thesis">
                            <label class="tada">Thesis</label>
                        </div>
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="Proposal">
                            <label class="tada">Proposal</label>
                        </div>
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="Capstone">
                            <label class="tada">Capstone</label>
                        </div>
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="System Studies">
                            <label class="tada">System Studies</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.getElementById('searchForm').addEventListener('submit', function(e) {
    const searchInput = document.getElementById('search').value.trim();
    const fromYear = document.getElementById('from-year').value.trim();
    const toYear = document.getElementById('to-year').value.trim();
    const checkboxes = document.querySelectorAll('input[name="document_types[]"]:checked');

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
