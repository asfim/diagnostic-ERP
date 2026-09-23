<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutPageRequest;
use App\Models\HomeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutPageController extends Controller
{
    public function index(): View
    {
        $about = HomeSetting::getSection('about_page_section', $this->defaults());

        return view('admin.about-page.index', compact('about'));
    }

    public function update(AboutPageRequest $request): RedirectResponse
    {
        $current = HomeSetting::getSection('about_page_section', []);
        $data = $request->validated();
        unset($data['about_image'], $data['infrastructure_image'], $data['remove_about_image'], $data['remove_infrastructure_image']);

        $data['features'] = array_values(array_filter($data['features']));
        $data['about_image'] = $this->storeImage($request, 'about_image', $current['about_image'] ?? null, 'remove_about_image');
        $data['infrastructure_image'] = $this->storeImage($request, 'infrastructure_image', $current['infrastructure_image'] ?? null, 'remove_infrastructure_image');

        HomeSetting::updateOrCreate(['key' => 'about_page_section'], ['value' => $data]);

        return redirect()->route('about-page.index')->with('success', 'About page updated successfully!');
    }

    private function storeImage(AboutPageRequest $request, string $field, ?string $current, string $removeField): ?string
    {
        if ($request->hasFile($field)) {
            if ($current) {
                Storage::disk('public')->delete($current);
            }

            return $request->file($field)->store('about', 'public');
        }

        if ($request->boolean($removeField)) {
            if ($current) {
                Storage::disk('public')->delete($current);
            }

            return null;
        }

        return $current;
    }

    private function defaults(): array
    {
        return [
            'label' => 'Who We Are',
            'title' => 'Dedicated to Precision and Care',
            'description' => 'MediDiag Diagnostic Center was established with a singular vision: to provide world-class, accurate, and rapid diagnostic services to the people of Bangladesh.',
            'quote' => 'Precision in every result, compassion in every interaction.',
            'years_number' => '15+',
            'years_text' => 'Years Experience',
            'features' => ['Advanced Equipment', 'Expert Pathologists', 'Accurate Reports', 'Fast Turnaround'],
            'button_text' => 'Contact Us',
            'button_link' => '/contact',
            'mission_title' => 'Our Mission',
            'mission_text' => 'To deliver precise, timely, and affordable diagnostic services to all segments of society while maintaining the highest ethical standards.',
            'vision_title' => 'Our Vision',
            'vision_text' => 'To become the leading and most trusted healthcare diagnostic brand in South Asia.',
            'values' => [
                ['title' => 'Integrity', 'description' => 'We uphold the highest moral standards in our practices.', 'icon' => 'bi-shield-check', 'color' => 'primary'],
                ['title' => 'Compassion', 'description' => 'We treat every patient with empathy and respect.', 'icon' => 'bi-heart', 'color' => 'danger'],
                ['title' => 'Excellence', 'description' => 'We continuously strive for clinical and service excellence.', 'icon' => 'bi-award', 'color' => 'secondary'],
                ['title' => 'Innovation', 'description' => 'Embracing new technologies for better diagnostics.', 'icon' => 'bi-lightbulb', 'color' => 'warning'],
            ],
            'infrastructure_title' => 'World-Class Infrastructure',
            'infrastructure_text' => 'Our laboratories are equipped with fully automated analyzers, ensuring zero manual error and fastest report delivery.',
            'infrastructure_points' => ['ISO 9001:2015 Certified Laboratories', 'Fully Automated Pathology Workflow', '3 Tesla MRI & 128 Slice CT Scan', 'Internal & External Quality Control'],
            'about_image' => null,
            'infrastructure_image' => null,
        ];
    }
}
