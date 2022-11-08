function isAccessTokenSet() {
  return goostavApplicationConfig.accessToken;
}
function getUrlParams() {
  const o = {
    profile: goostavApplicationConfig.activeBeProfile,
    platform: "WOO_COMMERCE",
    plugin_version: goostavApplicationConfig.pluginVersion,
    website_name: goostavApplicationConfig.storeName,
  };
  return isAccessTokenSet()
    ? {
        ...o,
        payload: {
          accessToken: goostavApplicationConfig.accessToken,
          type: goostavApplicationConfig.type,
        },
      }
    : {
        ...o,
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
function preparePayload(o) {
  return window.btoa(unescape(encodeURIComponent(JSON.stringify(o))));
}
function buildGoostavUrl() {
  const o = goostavApplicationConfig.rhEasyIFrameUrl,
    e = new URLSearchParams(),
    n = getUrlParams();
  for (let o in n)
    e.append(o, "string" == typeof n[o] ? n[o] : preparePayload(n[o]));
  return `${o}?${e}`;
}
async function updateConfig() {
  try {
    const o = await fetch(
      `/wp-json/omega-add-paypal-tracking/v1/config?clientToken=${goostavApplicationConfig.clientToken}`
    );
    o.ok &&
      ((goostavApplicationConfig = await o.json()),
      isAccessTokenSet() && window.clearInterval(interval));
  } catch {
    window.clearInterval(interval);
  }
}
let interval;
function setUpConfigRenewal() {
  interval ||
    isAccessTokenSet() ||
    (interval = window.setInterval(updateConfig, 1e4));
}
// document.addEventListener("DOMContentLoaded", function () {
//   document
//     .getElementById("omega-goto-goostav")
//     .addEventListener("click", function () {
//       window.open(buildGoostavUrl(), "omegahunter", "noreferrer"),
//         setUpConfigRenewal();
//     });
// });
