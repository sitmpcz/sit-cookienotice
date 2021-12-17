<?php

$cookie_config = '
// Dokumentace:
// https://github.com/orestbida/cookieconsent

var cc = initCookieConsent();

cc.run({
  current_lang: "cs",
  autoclear_cookies: true,
  page_scripts: true,
  languages: {
    "cs": {
      consent_modal: {
        title: "Používáme cookie!",
        description: \'Tento web je spravován společností SPRÁVA INFORMAČNÍCH TECHNOLIGIÍ MĚSTA PLZNĚ, příspěvková organizace a používá soubory cookie k zajištění funkčnosti webových stránek, jejich optimalizaci, pro správu preferencí, analýzu rozsahu a anonymní statistiky. Získané údaje jsou anonymní a nesdílíme je s nikým dalším. Kdykoli máte možnost využít svého práva poskytnout nebo neposkytnout souhlas s oprávněným zájmem na základě konkrétního účelu. To provedete v <button type="button" data-cc="c-settings" class="cc-link">nastavení</button>\',
        primary_btn: {
          text: "Přijmout vše",
          role: "accept_all"
        },
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
              readonly: true
            }
          },
          {
            title: "Analytické soubory cookie",
            description: "Pomáhají nám sestavit statistiky návštěvnosti webu. Konkrétně pomáhají sledovat počet návštěvníků, které stránky jsou nejoblíbenější, jakým způsobem se návštěvníci na webu pohybují a také z jakého zdroje provoz pochází. Všechny informace, které soubory cookie shromažďují, jsou souhrnné a anonymní.",
            toggle: {
              value: "analytics",
              enabled: false,
              readonly: false
            }
          },
          /*
          {
            title: "Marketingové soubory cookie",
            description: "Pomáhají sledovat, jak návštěvníci web používají, které stránky na webu navštěvují a na které odkazy klikají. Tyto anonymní informace využíváme v marketingovém nástroji Facebook Pixel. Všechny informace, které soubory cookie shromažďují, jsou souhrnné a anonymní.",
            toggle: {
              value: "marketing",
              enabled: false,
              readonly: false
            }
          },
          */
          {
            title: "Více informací",
            description: \'Pokud máte nějaké dotazy nebo připomínky <a class="cc-link" href="mailto:web@plzen.eu">kontaktujte nás</a>.\',
          }
        ]
      }
    }
  }
});
';
