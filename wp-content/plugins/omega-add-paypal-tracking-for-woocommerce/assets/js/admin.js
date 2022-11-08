function isAccessTokenSet() {
  return goostavApplicationConfig.accessToken;
}

function getUrlParams() {
  const defaultParams = {
    profile: goostavApplicationConfig.activeBeProfile,
    platform: "WOO_COMMERCE",
    plugin_version: goostavApplicationConfig.pluginVersion,
    website_name: goostavApplicationConfig.storeName,
  };

  if (isAccessTokenSet()) {
    return {
      ...defaultParams,
      payload: {
        accessToken: goostavApplicationConfig.accessToken,
        type: goostavApplicationConfig.type,
      },
    };
  } else {
    return {
      ...defaultParams,
      payload: {
        app_id: goostavApplicationConfig.appId,
        client_token: goostavApplicationConfig.clientToken,
        admin_email: goostavApplicationConfig.adminEmail,
        website_url: goostavApplicationConfig.storeUrl,
        release_platform: "WOO_COMMERCE",
        source_feed_url: goostavApplicationConfig.wooCommerceApiUrl,
        source_feed_username: goostavApplicationConfig.wooCommerceApiKey,
        source_feed_password: goostavApplicationConfig.wooCommerceApiSecret,
        currency: goostavApplicationConfig.storeCurrency,
        website_name: goostavApplicationConfig.storeName,
        api_base_url: goostavApplicationConfig.rhStateApiBaseUrl,
        language: goostavApplicationConfig.storeLanguage,
        country_code: goostavApplicationConfig.storeCountry,
      },
    };
  }
}

function preparePayload(payloadObject) {
  return window.btoa(
    unescape(encodeURIComponent(JSON.stringify(payloadObject)))
  );
}

function buildGoostavUrl() {
  const urlBase = goostavApplicationConfig.rhEasyIFrameUrl;
  const urlParams = new URLSearchParams();
  const params = getUrlParams();

  for (let param in params) {
    urlParams.append(
      param,
      typeof params[param] === "string"
        ? params[param]
        : preparePayload(params[param])
    );
  }

  return `${urlBase}?${urlParams}`;
}

async function updateConfig() {
  try {
    const response = await fetch(
      `/wp-json/omega-add-paypal-tracking/v1/config?clientToken=${goostavApplicationConfig.clientToken}`
    );
    if (response.ok) {
      goostavApplicationConfig = await response.json();

      if (isAccessTokenSet()) {
        window.clearInterval(interval);
      }
    }
  } catch {
    // it doesn't work, stop calling
    window.clearInterval(interval);
  }
}

let interval;

function setUpConfigRenewal() {
  if (!interval && !isAccessTokenSet()) {
    interval = window.setInterval(updateConfig, 10000);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const button = document.getElementById("omega-goto-goostav");
  button.addEventListener("click", function () {
    console.log(buildGoostavUrl);
    window.open(buildGoostavUrl(), "omegahunter", "noreferrer");
    setUpConfigRenewal();
  });
});
