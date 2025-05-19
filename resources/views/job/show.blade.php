<x-layout>
    <x-bread-crumbs :$job class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
    <x-job-card :$job />
</x-layout>
