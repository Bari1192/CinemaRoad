using OpenQA.Selenium;
using OpenQA.Selenium.Firefox;
using OpenQA.Selenium.Support.UI;

namespace AdminPanelTests;

[TestClass]
public class AdminPanelTests
{
    private WebDriver _webDdriver;
    private const string _sut = "http://frontend.cinemaroad/AdminPanel";

    [TestInitialize]
    public void InitializeWebDriver()
    {
        var firefoxOptions = new FirefoxOptions();
        
        _webDdriver = new FirefoxDriver(firefoxOptions);
    }

    [TestCleanup]
    public void TeardownWebDriver()
    {
        _webDdriver.Quit();
    }
    
    [TestMethod]
    public void Page_is_loaded()
    {
        _webDdriver.Url = _sut;
        Assert.IsNotNull(_webDdriver);
    }
    
    [TestMethod]
    public void Can_modify_purchase()
    {
        _webDdriver.Manage().Window.Size = new System.Drawing.Size(1920, 1080);

        _webDdriver.Url = "http://frontend.cinemaroad/Login";
        _webDdriver.FindElement(By.Name("email")).SendKeys("admin@gmail.com");
        _webDdriver.FindElement(By.Name("password")).SendKeys("Admin1234_");
        _webDdriver.FindElement(By.XPath("//button[contains(text(),'Bejelentkezés')]")).Click();
        System.Threading.Thread.Sleep(1000);

        _webDdriver.Url = _sut;
        var wait = new WebDriverWait(_webDdriver, TimeSpan.FromSeconds(10));
        var purchasesButton = wait.Until(d => d.FindElement(By.XPath("//button[contains(text(),'Vásárlások')]")));
        purchasesButton.Click();
        System.Threading.Thread.Sleep(1000);
        
        var firstEditButton = wait.Until(d => d.FindElement(By.XPath("//table//tbody//tr[1]//td[6]//button[contains(text(),'Módosítás')]")));
        firstEditButton.Click();

        var ticketsInput = wait.Until(d => d.FindElement(By.XPath("//table//tbody//tr[1]//td[4]//input")));

        ((IJavaScriptExecutor)_webDdriver)
            .ExecuteScript("arguments[0].value='D1'; arguments[0].dispatchEvent(new Event('input'));", ticketsInput);
        var saveButton = wait.Until(d => d.FindElement(By.XPath("//table//tbody//tr[1]//td[6]//button[contains(text(),'Mentés')]")));
        saveButton.Click();
        System.Threading.Thread.Sleep(2000);

    }

}