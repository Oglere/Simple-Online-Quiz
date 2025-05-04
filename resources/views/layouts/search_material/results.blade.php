
@if($results->isEmpty())
    <p>No results found.</p>
@else
    <ul>
    @foreach($results as $row)
        <li>
            <a href="{{ url('/study', $row->document_id) }}">{{ $row->title }}</a>

            <p>Authors: {{ $row->last_name }} ({{ $row->publication_year }})</p>

            <p>Keywords:
                @php
                    $keywords = is_string($row->keywords) ? json_decode($row->keywords, true) : $row->keywords;

                    if (!is_array($keywords)) {
                        $keywords = explode(',', $row->keywords);
                    }

                    $keywords = array_map('trim', $keywords);
                @endphp

                @if (empty(array_filter($keywords)))
                    No Keywords
                @else
                    {{ implode(', ', $keywords) }}
                @endif
            </p>

            <p>Study Type:
                @php
                    $studyType = is_string($row->study_type) ? json_decode($row->study_type, true) : $row->study_type;
                    if (!is_array($studyType)) {
                        $studyType = explode(',', $row->study_type);
                    }
                @endphp
                {{ implode(', ', array_map('trim', $studyType)) }}
            </p>
        </li>
    @endforeach

    </ul>
@endif