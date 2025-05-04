
<link rel="stylesheet" href="{{ asset ('css/pdf_identification.css') }}">

@if(Auth::user()->role == "Teacher")
    @if ($document->status === "Pending")
        <div class="hellneh">
            <button id="approveBtn" class="btn">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="url(#gradient)"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-check-square"
                >
                    <defs>
                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color: rgba(105,255,78,1); stop-opacity: 1" />
                            <stop offset="100%" style="stop-color: rgba(149, 254, 255, 1); stop-opacity: 1" />
                        </linearGradient>
                    </defs>
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                &nbsp;
                Approve
            </button>

            <button id="revisionBtn" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" 
                        width="24" height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        class="feather feather-info">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    &nbsp;
                    Needs Revisions
            </button>

            <button id="rejectBtn" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                &nbsp;
                Reject
            </button>
        </div>

    @elseif ($document->status !== "Approved" or "Pending")
        <button 
        style="
            background-color: black;
            border-radius: 49px;
            position: absolute;
            margin-top: 140px;
            margin-right: 40px;
            width: 175px;
            font-weight: lighter;
            height: 40px;
            border: none;
            cursor: pointer;
            transition: all 0.1s ease;
            color: white;
            font-family: `rubik`
        " 
        id="recoverBtn" 
        class="btn">
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
                class="feather feather-rotate-ccw"
            >
                <polyline points="1 4 1 10 7 10"/>
                <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/>
            </svg>
            &nbsp;
            Revert Changes
        </button>
    @endif
@endif

@if(Auth::user()->role == "Student" && $document->status == "Pending")
    <button class="asd open-modal" data-modal="abandonModal" data-document-id="{{ $document->id }}" 
    style="
        background-color: #8e0404;
        border-radius: 49px;
        position: absolute;
        margin-top: 140px;
        margin-right: 40px;
        width: 175px;
        font-weight: lighter;
        height: 40px;
        display: flex;
        border: none;
        cursor: pointer;
        transition: all 0.1s ease;
        align-items: center;
        justify-content: center;
        color: white;
        font-family: `rubik`;
    ">
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
            class="feather feather-trash"
            >
            <polyline points="3 6 5 6 21 6" />
            <path
                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
            />                                                              
        </svg>
        &nbsp;
        Abandon Document
    </button>

@elseif (Auth::user()->role == "Student" && $document->status == "Abandoned")
    <button class="asd open-modal" data-modal="abandonModal" data-document-id="{{ $document->id }}" 
        style="
            background-color: green;
            border-radius: 49px;
            position: absolute;
            margin-top: 140px;
            margin-right: 40px;
            width: 175px;
            font-weight: lighter;
            height: 40px;
            display: flex;
            border: none;
            cursor: pointer;
            transition: all 0.1s ease;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: `rubik`;
        ">
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
            class="feather feather-rotate-ccw"
        >
            <polyline points="1 4 1 10 7 10"/>
            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/>
        </svg>
        &nbsp;
        Recover Document
    </button>
@endif

@if(Auth::user()->role == "Teacher")
    @if ($document->status === "Pending")
        <div id="approveModal" class="modal">
            <div class="modal-content">
                <h2>Approve Document</h2>
                <p>Are you sure you want to approve this document?</p>
                <div class="modal-actions">
                    <form action="{{ url('teacher/review-studies/request/' . $document->document_id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="document_id" id="approveDocumentId">
                        <input type="hidden" name="action" value="Approved">
                        <button type="submit" class="batan confirm">Confirm</button>
                        <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="revisionModal" class="modal">
            <div class="modal-content">
                <h2>Request Revisions</h2>
                <p>Are you sure you want to request revisions for this document?</p>
                <div class="modal-actions">
                    <form action="request/{{ $document->document_id }}" method="POST">
                        @csrf
                        <input type="hidden" name="document_id" id="revisionDocumentId">
                        <input type="hidden" name="action" value="Needs Revision">
                        <button type="submit" class="batan confirm">Confirm</button>
                        <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="rejectModal" class="modal">
            <div class="modal-content">
                <h2>Reject Document</h2>
                <p>Are you sure you want to reject this document?</p>
                <div class="modal-actions">
                    <form action="request/{{ $document->document_id }}" method="POST">
                        @csrf
                        <input type="hidden" name="document_id" id="rejectDocumentId">
                        <input type="hidden" name="action" value="Rejected">
                        <button type="submit" class="batan confirm">Confirm</button>
                        <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

    @elseif ($document->status != "Approved" or "Pending")
        <div id="recoverModal" class="modal">
            <div class="modal-content">
                <h2>Revert Changes</h2>
                <p>Are you sure you want to revert the changes on this document?</p>
                <div class="modal-actions">
                    <form action="request/{{ $document->document_id }}" method="POST">
                        @csrf
                        <input type="hidden" name="document_id" id="recoverDocumentId">
                        <input type="hidden" name="action" value="Pending">
                        <button style="background-color: black;" type="submit" class="batan confirm">Confirm</button>
                        <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    @endif

@elseif (Auth::user()->role == "Student")
    @if ($document->status === 'Pending')
        <div id="abandonModal" class="modal">
            <div class="modal-content">
                <h2>Abandon Document</h2>
                <p>Are you sure you want to abandon this document? <br> You can still recover this document later.</p>
                <div class="modal-actions">
                    <form action="request" method="POST">
                        @csrf
                        <input type="hidden" name="document_id" id="documentIdInput" value="{{ $document->document_id }}">
                        <input type="hidden" name="action" value="Abandoned">
                        <button type="submit" class="batan confirm">Confirm</button>
                        <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    @elseif ($document->status === 'Abandoned')
        <div id="abandonModal" class="modal">
            <div class="modal-content">
                <h2 style="color: green;">Recover Document</h2>
                <p>Are you sure you want to recover this document?</p>
                <div class="modal-actions">
                    <form action="request" method="POST">
                        @csrf
                        <input type="hidden" name="document_id" id="documentIdInput" value="{{ $document->document_id }}">
                        <input type="hidden" name="action" value="Pending">
                        <button type="submit" class="batan confirm" style="background-color: green;" >Confirm</button>
                        <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endif

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const documentId = {{ $document->document_id }};

    // Button-to-Modal Mapping
    const buttons = {
        abandonBtn: "abandonModal",
        approveBtn: "approveModal",
        revisionBtn: "revisionModal",
        rejectBtn: "rejectModal",
        recoverBtn: "recoverModal",
    };

    // Open Modal Logic
    Object.keys(buttons).forEach((btnId) => {
        const button = document.getElementById(btnId);
        if (button) {
            button.onclick = () => {
                const modal = document.getElementById(buttons[btnId]);
                if (modal) {
                    modal.style.display = "block";
                    const input = modal.querySelector("input[type='hidden']");
                    if (input) input.value = documentId;
                }
            };
        }
    });

    // Close Modal Logic
    const modals = document.querySelectorAll(".modal");
    modals.forEach((modal) => {
        modal.querySelector(".cancel")?.addEventListener("click", () => {
            modal.style.display = "none";
        });
    });

    // Close Modal When Clicking Outside
    window.onclick = (event) => {
        modals.forEach((modal) => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    };
});

</script>


<script>
const modal = document.getElementById("abandonModal");
const abandonBtn = document.getElementById("abandonBtn");
const confirmAbandon = document.querySelector(".confirm");

abandonBtn.onclick = () => {
    const documentId = {{ $document->document_id }};
    document.getElementById("documentIdInput").value = documentId;
    modal.style.display = "block";
};

function closeModal() {
    modal.style.display = "none";
}

window.onclick = (event) => {
    if (event.target == modal) {
        closeModal();
    }
};
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById('pdf-container');
    const url = "{{ asset('storage/pdfs/' . $document->file_path) }}";
    let pdfDoc = null, scale = 1.5;

    pdfjsLib.getDocument(url).promise.then(pdf => {
        pdfDoc = pdf;
        document.getElementById('total-pages').textContent = pdfDoc.numPages;
        for (let i = 1; i <= pdfDoc.numPages; i++) {
            renderPage(i);
        }
        document.getElementById('loading-overlay').style.display = 'none';
        document.getElementById('pdf-content').style.display = 'flex';
    });

    function renderPage(num) {
        pdfDoc.getPage(num).then(page => {
            const viewport = page.getViewport({ scale });
            const canvas = document.createElement('canvas');
            canvas.className = 'page';
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            container.appendChild(canvas);
            page.render({ canvasContext: context, viewport });
        });
    }

    // Modal Handling
    document.querySelectorAll(".open-modal").forEach(button => {
        button.addEventListener("click", () => {
            const modalId = button.getAttribute("data-modal");
            const documentId = button.getAttribute("data-document-id");
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = "block";
                modal.querySelector(".document-id-input").value = documentId;
            }
        });
    });

    document.querySelectorAll(".cancel").forEach(button => {
        button.addEventListener("click", closeModal);
    });

    window.onclick = (event) => {
        document.querySelectorAll(".modal").forEach(modal => {
            if (event.target == modal) {
                closeModal();
            }
        });
    };

    function closeModal() {
        document.querySelectorAll(".modal").forEach(modal => modal.style.display = "none");
    }
});
</script>