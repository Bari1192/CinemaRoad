using OpenQA.Selenium;
using OpenQA.Selenium.Firefox;
using OpenQA.Selenium.Support.UI;

namespace SelectorPageTests;

[TestClass]
public class LocationChoosePageTests
{
    private WebDriver _webDdriver;
    private const string _sut = "http://frontend.cinemaroad/LocationChoose";

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
    public void PageIsLoaded()
    {
        _webDdriver.Url = _sut;
        Assert.IsNotNull(_webDdriver);
    }
    
    [TestMethod]
    public void TitleIsPresent()
    {
        _webDdriver.Url = _sut;
        
        var title = _webDdriver.Title;
        
        Assert.IsNotNull(title);
    }
    
    [TestMethod]
    public void LocationCardIsPresent()
    {
        _webDdriver.Url = _sut;

        var locationCard = _webDdriver.FindElement(By.CssSelector("div.card"));

        Assert.IsNotNull(locationCard);
    }
    
    [TestMethod]
    public void StarFieldCardPresent()
    {
        _webDdriver.Url = _sut;

        var locationCard = _webDdriver.FindElement(By.XPath("//img[@alt='Starfield']"));
        Assert.IsNotNull(locationCard);
    }
    
    [TestMethod]
    public void StarFieldCardNavigation()
    {
        _webDdriver.Url = _sut;

        var image = _webDdriver.FindElement(By.XPath("//img[@alt='Starfield']"));
        image.Click();

        var wait = new WebDriverWait(_webDdriver, TimeSpan.FromSeconds(5));
        wait.Until(driver => driver.Url.Contains("/Selector"));

        Assert.IsTrue(_webDdriver.Url.Contains("/Selector"));
    }
    
    
    
    
}