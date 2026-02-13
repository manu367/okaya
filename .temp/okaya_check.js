const { Builder, Browser, By, Key, until ,Select}
    = require('selenium-webdriver');

(async function cantrackAutomation() {
    let driver = await new Builder().forBrowser(Browser.CHROME).build();

    try {
        await driver.get('http://localhost/Okaya/index.php');
        await driver.wait(until.elementLocated(By.id('userid')), 10000);
        await driver.findElement(By.id('userid')).sendKeys('test');
        await driver.findElement(By.id('pwd')).sendKeys('123');
        await driver.findElement(By.css('button[type="submit"]')).click();

        await driver.wait(until.elementLocated(By.id('menu-content')), 10000);
        await driver.findElement(By.xpath("//a[contains(text(),'Masters')]")).click();
        await driver.findElement(By.xpath("//a[contains(@href,'adminusermgt.php')]")).click();

        await driver.findElement(By.css("#home .form-group button[title='Add New User']")).click();

        await driver.wait(until.elementLocated(By.id('usrname')), 10000);
        await driver.findElement(By.id('usrname')).sendKeys('Manu Pathak');
        await driver.findElement(By.id('pwd')).sendKeys('Iammanupathak');
        await driver.findElement(By.id('phone')).sendKeys('1234567890');


        await driver.wait(until.elementLocated(By.id('state')), 10000);
        await driver.findElement(By.id('state')).click();

        await driver.findElement(
            By.xpath("//select[@id='state']/option[@value='22']")
        ).click();
        await driver.wait(until.elementLocated(By.id('city')), 10000);
        await driver.findElement(By.id('city')).click();
        await driver.findElement(
            By.xpath("//select[@id='city']/option[@value='1638']")
        ).click();
        // Email
        await driver.findElement(By.id('email')).sendKeys('manu@test.com');

        await driver.sleep(2000);
// ---------------- USER TYPE ----------------
        await driver.wait(until.elementLocated(By.id('u_type')), 10000);
        await driver.findElement(By.id('u_type')).click();
        await driver.findElement(
            By.xpath("//select[@id='u_type']/option[@value='admin']")
        ).click();
        await driver.sleep(2000);

// ---------------- STATE ----------------
        await driver.wait(until.elementLocated(By.id('state')), 10000);
        await driver.findElement(By.id('state')).click();
        await driver.findElement(
            By.xpath("//select[@id='state']/option[@value='22']")   // Uttar Pradesh
        ).click();
        await driver.sleep(2000);

// Wait for city to load (important if dependent)
        await driver.wait(
            until.elementLocated(By.xpath("//select[@id='city']/option[@value='1638']")),
            10000
        );
        await driver.sleep(2000);
        await driver.findElement(By.id('city')).click();
        await driver.findElement(
            By.xpath("//select[@id='city']/option[@value='1638']")   // Bijnore
        ).click();
        await driver.sleep(2000);
        await driver.wait(until.elementLocated(By.id('designation')), 10000);
        await driver.findElement(By.id('designation')).click();
        await driver.findElement(
            By.xpath("//select[@id='designation']/option[@value='4']")  // Admin
        ).click();
        await driver.sleep(2000);
        await driver.findElement(By.id('address'))
            .sendKeys('Lucknow, Uttar Pradesh');
        await driver.sleep(2000);
        await driver.wait(until.elementLocated(By.id('status')), 10000);
        await driver.findElement(By.id('status')).click();
        await driver.findElement(
            By.xpath("//select[@id='status']/option[@value='1']")   // Active
        ).click();
        await driver.sleep(2000);
        await driver.findElement(By.id('add')).click();
        await driver.sleep(2000);


    } catch (err) {
        console.error('Scene gadbad hai:', err);
    } finally {
    }
})();

