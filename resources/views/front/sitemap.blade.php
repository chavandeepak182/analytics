<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Homepage -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Reports Page -->
    <url>
        <loc>{{ url('/research-reports/all') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Upcoming Reports Page -->
    <url>
        <loc>{{ url('/upcomingreport/all') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- About Us Page -->
    <url>
        <loc>{{ url('/aboutus') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Contact Us Page -->
    <url>
        <loc>{{ url('/contactus') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Careers Page -->
    <url>
        <loc>{{ url('/careers') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Research Methodology Page -->
    <url>
        <loc>{{ url('/research-methodology') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Services Page -->
    <url>
        <loc>{{ url('/services') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <!-- Services - Consulting Page -->
    <url>
        <loc>{{ url('/services/consulting') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <!-- Services - Subscription Page -->
    <url>
        <loc>{{ url('/services/subscription') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Services - Custom Market Research Page -->
    <url>
        <loc>{{ url('/services/custom-market-research') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Services - We Market Client Support Page -->
    <url>
        <loc>{{ url('/services/we-market-client-support') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Blogs Page -->
    <url>
        <loc>{{ url('/blog') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Press Release Page -->
    <url>
        <loc>{{ url('/press-release') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Infogragraphics Page -->
    <url>
        <loc>{{ url('/infographics') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Terms of Use Policy Page -->
    <url>
        <loc>{{ url('/terms-of-use') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Privacy Policy Page -->
    <url>
        <loc>{{ url('/privacy-policy') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Categories Details with Reports and Upcoming Reports-->
    @foreach ($report_catgories as $category)
        <url>
            <loc>{{ !empty($category) ? url('/research-reports/'.Str::slug(Str::replace('&','and',$category->category_name) , '-').'/'.$category->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($category->created_at) ? $category->updated_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($category) ? url('/upcomingreport/'.Str::slug(Str::replace('&','and',$category->category_name) , '-').'/'.$category->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($category->created_at) ? $category->updated_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Reports Details With all Request Forms And Tabs -->
    @foreach ($reports as $report)
        <url>
            <loc>{{ !empty($report->url) ? url('/reports/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($report->url) ? url('/sample-request/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($report->url) ? url('/customization/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($report->url) ? url('/analyst/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($report->url) ? url('/discount/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($report->url) ? url('reports/toc/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($report->url) ? url('reports/research-methodology/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($report->url) ? url('reports/infographics/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($report->url) ? url('reports/request-free-sample-pdf/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($report->url) ? url('purchase/'.$report->url.'/'.$report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($report->created_at) ? $report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Upcoming Reports Details With all Tabs -->
    @foreach ($upcoming_reports as $upcoming_report)
        <url>
            <loc>{{ !empty($upcoming_report->url) ? url('/reports/'.$upcoming_report->url.'/'.$upcoming_report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($upcoming_report->created_at) ? $upcoming_report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($upcoming_report->url) ? url('reports/toc/'.$upcoming_report->url.'/'.$upcoming_report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($upcoming_report->created_at) ? $upcoming_report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($upcoming_report->url) ? url('reports/research-methodology/'.$upcoming_report->url.'/'.$upcoming_report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($upcoming_report->created_at) ? $upcoming_report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($upcoming_report->url) ? url('reports/infographics/'.$upcoming_report->url.'/'.$upcoming_report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($upcoming_report->created_at) ? $upcoming_report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ !empty($upcoming_report->url) ? url('reports/request-free-sample-pdf/'.$upcoming_report->url.'/'.$upcoming_report->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($upcoming_report->created_at) ? $upcoming_report->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Blog Details -->
    @foreach ($blogs as $blog)
        <url>
            <loc>{{ !empty($blog) ? url('/blog-details/'.$blog->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($blog->created_at) ? $blog->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Press Release Details -->
    @foreach ($press_release as $press)
        <url>
            <loc>{{ !empty($press) ? url('/press-release-view/'.$press->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($press->created_at) ? $press->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Infographics Details -->
    @foreach ($infographics as $infographic)
        <url>
            <loc>{{ !empty($infographic) ? url('/infographics-details/'.$infographic->id) : url('/404') }}</loc>
            {{-- <lastmod>{{ !empty($infographic->created_at) ? $infographic->created_at->tz('UTC')->toAtomString() : '' }}</lastmod> --}}
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>