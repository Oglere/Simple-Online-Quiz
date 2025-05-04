<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Read: {{ $document->title }}</title>
    <link rel="stylesheet" href="{{ asset ('css/std.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/mainpage.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/std_control.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/std.pdf.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/svg.css') }}">
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../../Imgs/DARA.png" alt="" class="ahh">
            </div>
            @include('layouts.pdf_identification')
        </header>
         
        <div class="main" style="height: calc(100% - 61px)">
            <div class="left">
                <div class="profile">
                    <h2>{{ auth()->user()->first_name }}</h2>
                </div>

                <nav class="nav-links">
                    <a href="/teacher"> 
                        <svg
                            style="margin-right: 10px;"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-home"
                            >
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>

                        Dashboard
                    </a>
                    <a href="/teacher/review-studies">
                        <svg
                            style="margin-right: 10px;"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-book-open"
                            >
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                        </svg>

                        Review Studies
                    </a>

                    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>

                    <a href="/" class="unq">Search Studies</a>
                    <a href="/teacher/edit" class="unq">Edit Account</a>

                    <div class="asd2" style=" width: 100%; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>

                    <form action="/out" method="POST">
                        @csrf
                        <button class="lgt">
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
                                class="feather feather-log-in"
                                >
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <polyline points="10 17 15 12 10 7" />
                                <line x1="15" y1="12" x2="3" y2="12" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
 
            <div class="right" style="overflow: auto;">
                <div id="loading-overlay">
                <div class="loader"></div>
                <p>Loading...</p>
            </div>

            <div class="pdfmain" style="display: none; flex-direction: column;" id="pdf-content">
                <div class="navnav">
                    <div class="leftnav">
                        <div class="pdfaside">
                            <div class="nav">
                                @switch($document->status)
                                    @case("Approved")
                                        <p><strong style="color: green;"> {{ $document->status }} </strong></p>
                                        @break
                                    @case("Rejected")
                                        <p><strong style="color: #8e0404ed;"> {{ $document->status }} </strong></p>
                                        @break
                                    @case("Needs Revision")
                                        <p><strong style="color: orange;"> {{ $document->status }} </strong></p>
                                        @break
                                    @case("Pending")
                                        <p><strong style="color: #04128e;"> {{ $document->status }} </strong></p>
                                        @break
                                
                                    @default
                                        
                                @endswitch
                            </div>
                            <h2>{{ $document->title }}</h2>
                            <p style="text-align: justify; margin-right: 30%;"><strong>Abstract:</strong> <?= $abstract ?></p>
                            <p><strong>Date Submitted:</strong> {{ $document->date_submitted }}</p>
                            <p><strong>Study Type:</strong> {{ !empty($study_type) ? implode(', ', $study_type) : 'No keywords available.' }}</p>
                        </div>
                    </div>
                </div>

                <div class="pdfcontents">
                    <div id="pdf-container"></div>
                </div>
            </div>

            <style>
                #loading-overlay {
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(255, 255, 255, 1);
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.5em;
                    z-index: 9999;
                }

                .loader {
                    border: 6px solid #f3f3f3;
                    border-top: 6px solid #04128e;
                    border-radius: 50%;
                    width: 50px;
                    height: 50px;
                    animation: spin 1s linear infinite;
                    margin-bottom: 20px;
                }

                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            </style>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
            <script>
                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

                const url = 'data:application/pdf;base64,{{ $pdf_data }}';
                let pdfDoc = null, scale = 1.5;
                const container = document.getElementById('pdf-container');

                pdfjsLib.getDocument(url).promise.then(pdf => {
                    pdfDoc = pdf;
                    renderAllPages();

                    document.getElementById('loading-overlay').style.display = 'none';
                    document.getElementById('pdf-content').style.display = 'flex';
                }).catch(error => console.error('Error loading PDF:', error));

                function renderAllPages() {
                    for (let i = 1; i <= pdfDoc.numPages; i++) {
                        renderPage(i);
                    }
                }

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
                    }).catch(error => console.error('Error rendering page:', error));
                }
            </script>
        </div>
    </main>
</body>
</html>
<script src="js/index.js"></script>
