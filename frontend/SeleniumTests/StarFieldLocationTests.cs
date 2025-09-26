using OpenQA.Selenium;
using OpenQA.Selenium.Firefox;
using OpenQA.Selenium.Support.UI;

namespace StarFieldLocationTests;

[TestClass]
public class StarFieldLocationTests
{
    private WebDriver _webDdriver;
    private const string _sut = "http://frontend.cinemaroad/starfield";

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
    public void LocationDescriptionIsPresent()
    {
        _webDdriver.Url = _sut;
        
        var title = _webDdriver.FindElement(By.TagName("p"));
        
        Assert.IsNotNull(title);
    }
    
    [TestMethod]
    public void H1IsPresent()
    {
        _webDdriver.Url = _sut;
        var wait = new WebDriverWait(_webDdriver, TimeSpan.FromSeconds(10)); // increase timeout if needed

        var h1 = wait.Until(driver => driver.FindElement(By.TagName("h1")));

        Assert.IsNotNull(h1);
    }

    
    [TestMethod]
    public void BaseCard_components_are_present()
    {
        _webDdriver.Url = _sut;
        System.Threading.Thread.Sleep(1000);

        var gridDiv = _webDdriver.FindElement(By.CssSelector("div.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4.gap-6.pt-10"));
        var cards = gridDiv.FindElements(By.XPath("./*")); // all direct children
        Assert.IsTrue(cards.Count > 1, $"Expected multiple cards, but found {cards.Count}");
    }

}