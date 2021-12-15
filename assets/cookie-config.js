// obtain plugin
var cc = initCookieConsent();

// run plugin with your configuration
cc.run({
  current_lang: "cs",
  autoclear_cookies: true,                   // default: false
  //theme_css: "<path-to-cookieconsent.css>",  // 🚨 replace with a valid path
  page_scripts: true,                        // default: false

  // delay: 0,                               // default: 0
  // auto_language: null                     // default: null; could also be "browser" or "document"
  // autorun: true,                          // default: true
  // force_consent: false,                   // default: false
  // hide_from_bots: false,                  // default: false
  // remove_cookie_tables: false             // default: false
  // cookie_name: "cc_cookie",               // default: "cc_cookie"
  // cookie_expiration: 182,                 // default: 182 (days)
  // cookie_domain: location.hostname,       // default: current domain
  // cookie_path: "/",                       // default: root
  // cookie_same_site: "Lax",                // default: "Lax"
  // use_rfc_cookie: false,                  // default: false
  // revision: 0,                            // default: 0

  onAccept: function (cookie) {
    // ...
  },

  onChange: function (cookie, changed_preferences) {
    // ...
  },

  languages: {
    "cs": {
      consent_modal: {
        title: "Používáme cookie!",
        description: 'Tento web je spravován společností SPRÁVA INFORMAČNÍCH TECHNOLIGIÍ MĚSTA PLZNĚ, příspěvková organizace a používá soubory cookie k zajištění funkčnosti webových stránek, jejich optimalizaci, pro správu preferencí, analýzu rozsahu a anonymní statistiky. Získané údaje jsou anonymní a nesdílíme je s nikým dalším. Kdykoli máte možnost využít svého práva poskytnout nebo neposkytnout souhlas s oprávněným zájmem na základě konkrétního účelu. To provedete v <button type="button" data-cc="c-settings" class="cc-link">nastavení</button>',
        primary_btn: {
          text: "Přijmout vše",
          role: "accept_all"              // "accept_selected" or "accept_all"
        },

        //secondary_btn: {
        //  text: "Reject all",
        //  role: "accept_necessary"        // "settings" or "accept_necessary"
        //}

      },
      settings_modal: {
        title: "Nastavení cookie",
        save_settings_btn: "Uložit",
        accept_all_btn: "Přijmout vše",
        reject_all_btn: "Odmítnout vše",
        close_btn_label: "Zavřít",
        cookie_table_headers: [
          {col1: "Name"},
          {col2: "Domain"},
          {col3: "Expiration"},
          {col4: "Description"}
        ],
        blocks: [
          {
            title: "Používáme soubory cookie 📢",
            description: "Soubory cookie jsou krátké textové soubory, které si navštívený web ukládá ve vašem prohlížeči. Umožňují webu zaznamenat informace o vaší návštěvě a ty následně použít ke správnému fungování webu, případně ke statistickým nebo marketingovým účelům. Prohlížeč můžete nastavit tak, aby blokoval soubory cookie nebo o nich posílal upozornění. Mějte však na paměti, že některé stránky bez těchto souborů nemusí fungovat správně."
          },
          {
            title: "Naprosto nezbytné soubory cookie",
            description: "Jsou nezbytné k tomu, aby web fungoval, takže není možné je vypnout. Většinou jsou nastavené jako odezva na akce, které jste provedli, jako je požadavek služeb týkajících se bezpečnostních nastavení, přihlašování, vyplňování formulářů atp. Tyto soubory cookie neukládají žádné osobní identifikovatelné informace.",
            toggle: {
              value: "necessary",
              enabled: true,
              readonly: true          // cookie categories with readonly=true are all treated as "necessary cookies"
            }
          },
          {
            title: "Analitické soubory cookie",
            description: "Pomáhají nám sestavit statistiky návštěvnosti webu. Konkrétně pomáhají sledovat počet návštěvníků, které stránky jsou nejoblíbenější, jakým způsobem se návštěvníci na webu pohybují a také z jakého zdroje provoz pochází. Všechny informace, které soubory cookie shromažďují, jsou souhrnné a anonymní.",
            toggle: {
              value: "analytics",     // your cookie category
              enabled: false,
              readonly: false
            },
            cookie_table: [             // list of all expected cookies
              {
                col1: "^_ga",       // match all cookies starting with "_ga"
                col2: "google.com",
                col3: "2 years",
                col4: "description ...",
                is_regex: true
              },
              {
                col1: "_gid",
                col2: "google.com",
                col3: "1 day",
                col4: "description ...",
              }
            ]
          },
          {
            title: "Marketingové soubory cookie",
            description: "Pomáhají sledovat, jak návštěvníci web používají, které stránky na webu navštěvují a na které odkazy klikají. Tyto anonymní informace využíváme v marketingovém nástroji Facebook Pixel. Všechny informace, které soubory cookie shromažďují, jsou souhrnné a anonymní.",
            toggle: {
              value: "marketing",
              enabled: false,
              readonly: false
            }
          },
          {
            title: "Více informací",
            description: 'Pokud máte nějaké dotazy nebo připomínky <a class="cc-link" href="mailto:web@plzen.eu">kontaktujte nás</a>.',
          }
        ]
      }
    }
  }
});
