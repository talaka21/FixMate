<h2>New Service Provider Request</h2>

<p><strong>Provider Name:</strong> {{ $provider->provider_name }}</p>
<p><strong>Shop Name:</strong> {{ $provider->shop_name }}</p>
<p><strong>Description:</strong> {{ $provider->description }}</p>
<p><strong>Phone:</strong> {{ $provider->phone }}</p>
<p><strong>WhatsApp:</strong> {{ $provider->whatsapp ?? 'N/A' }}</p>
<p><strong>Facebook:</strong> {{ $provider->facebook ?? 'N/A' }}</p>
<p><strong>Instagram:</strong> {{ $provider->instagram ?? 'N/A' }}</p>
<p><strong>Category:</strong> {{ optional($provider->category)->name }}</p>
<p><strong>Subcategory:</strong> {{ optional($provider->subcategory)->name }}</p>
<p><strong>State:</strong> {{ optional($provider->state)->name }}</p>
<p><strong>City:</strong> {{ optional($provider->city)->name }}</p>
