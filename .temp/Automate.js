const { Builder, Browser, By, Key, until } = require('selenium-webdriver');

(async function cantrackAutomation() {
    let driver = await new Builder().forBrowser(Browser.CHROME).build();

    try {
        // STEP 0: Open site
        await driver.get('https://candour.cansale.in/cantrack');

        // STEP 1: Login
        await driver.wait(until.elementLocated(By.id('userid')), 10000);
        await driver.findElement(By.id('userid')).sendKeys('CSEMP0040');

        await driver.findElement(By.id('pwd')).sendKeys('123');

        await driver.findElement(By.id('button')).click();

        // STEP 2: Home page load hone ka wait
        await driver.wait(until.elementLocated(By.id('menu-content')), 10000);

        // STEP 3: menu-content ke 2nd li par click
        const menu = await driver.findElement(By.id('menu-content'));
        const secondLi = await menu.findElement(By.css('li:nth-child(2)'));
        await secondLi.click();

        // thoda sa ruk ja, zindagi tez nahi hoti
        await driver.sleep(3000);

    } catch (err) {
        console.error('Scene gadbad hai:', err);
    } finally {
        //await driver.quit();
    }
})();
