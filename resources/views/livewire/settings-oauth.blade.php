<div>
    <x-slot:title>
        Settings | Coolify
    </x-slot>
    <x-settings.navbar />
    <form wire:submit='submit' class="flex flex-col">
        <div class="flex flex-col">
            <div class="flex items-center gap-2 pb-2">
                <h2>Authentication</h2>
                <x-forms.button type="submit">
                    Save
                </x-forms.button>
            </div>
            <div class="pb-4 ">Custom authentication (OAuth) configurations.</div>
        </div>
        <div class="flex flex-col gap-2 pt-4">
            @foreach ($oauth_settings_map as $oauth_setting)
                <div class="p-4 border dark:border-coolgray-300 border-neutral-200">
                    <h3>{{ ucfirst($oauth_setting->provider) }}</h3>
                    <div class="w-32">
                        <x-forms.checkbox instantSave="instantSave('{{ $oauth_setting->provider }}')"
                            id="oauth_settings_map.{{ $oauth_setting->provider }}.enabled" label="Enabled" />
                    </div>
                    <div class="flex flex-col w-full gap-2 xl:flex-row">
                        <x-forms.input id="oauth_settings_map.{{ $oauth_setting->provider }}.client_id"
                            label="Client ID" />
                        <x-forms.input id="oauth_settings_map.{{ $oauth_setting->provider }}.client_secret"
                            type="password" label="Client Secret" autocomplete="new-password" />
                        <x-forms.input id="oauth_settings_map.{{ $oauth_setting->provider }}.redirect_uri"
                            placeholder="{{ route('auth.callback', $oauth_setting->provider) }}" label="Redirect URI" />
                        @if ($oauth_setting->provider == 'azure')
                            <x-forms.input id="oauth_settings_map.{{ $oauth_setting->provider }}.tenant"
                                label="Tenant" />
                        @endif
                        @if ($oauth_setting->provider == 'google')
                            <x-forms.input id="oauth_settings_map.{{ $oauth_setting->provider }}.tenant"
                                helper="Optional parameter that supplies a hosted domain (HD) to Google, which<br>triggers a login hint to be displayed on the OAuth screen with this domain.<br><br><a class='underline dark:text-warning text-coollabs' href='https://developers.google.com/identity/openid-connect/openid-connect#hd-param' target='_blank'>Google Documentation</a>"
                                label="Tenant" />
                        @endif
                        @if (
                            $oauth_setting->provider == 'authentik' ||
                                $oauth_setting->provider == 'clerk' ||
                                $oauth_setting->provider == 'zitadel')
                            <x-forms.input id="oauth_settings_map.{{ $oauth_setting->provider }}.base_url"
                                label="Base URL" />
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </form>
</div>
