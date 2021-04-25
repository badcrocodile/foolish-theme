
The Motley Fool Code Challenge
===

Included please find 3 primary components:
- **Foolish Stock Advisor:** An Underscores based theme for displaying content, as described in the requirements.
- **Foolish Company Data:** A plugin to handle API integration with the Financial Modeling Prep API, as described in the requirements.

## Installation:
**Optional Requirements:**
You'll need [Composer](https://getcomposer.org/) if you want to run the unit tests, code sniffers, mess detectors, etc.

**Installation:**
1. Download or clone the theme from the [GitHub Repo](https://github.com/badcrocodile/foolish-theme)
1. Download or clone the plugin from the [GitHub Repo](https://github.com/badcrocodile/foolish-plugin)
1. Extract the plugin into `/wp-content/plugins/` and activate
1. Enter your API key in the plugin options page at `Admin -> Settings -> Foolish Plugin Settings`
1. Extract the theme into `/wp-content/themes/` and activate
1. Add the "Categories" widget to your primary sidebar `Admin -> Appearance -> Widgets`

## Now the fun starts! Let's walk through those requirements:

---

> > ### Story 1: Create a News article
> A News article has the following requirements:
>
> - The author needs to be able to write and edit the article.
> - The author needs to be able to associate the article with the ticker symbol for the stock being discussed, if any, e.g. NASDAQ:SBUX.
> - Once published, the article needs to display the following:
>   - The author’s name
>   - The date that the article was published
>   - The article itself

**Steps to validate:**
- Log in to the admin and create a post.
- To associate the article with a ticker symbol:
    - Make sure that "Post" is the active selection for the sidebar.
    - Locate the "Associated Company" metabox in the sidebar.
    - Select a company ticker from the list. If your desired company isn't listed, click the blue "+" (plus) sign to add a new ticker.
- Optionally assign a category
- Publish your content

---

> > ### Story 2: Create a Stock Recommendation article
> The Stock Recommendation article has the following requirements:
>
> - The author needs to be able to write and edit the article.
> - The author needs to be able to associate the article with the ticker symbol for the stock being recommended, e.g. NASDAQ:SBUX.
> - Once published, the article needs to display the following:
>   - The author’s name
>   - The date that the recommendation was published
>   - The article itself
> - In a sidebar or callout box, it should display the following pieces of company profile information, which will come from an API call (see note below):
>   - Company Logo
>   - Company Name
>   - Exchange
>   - Description
>   - Industry
>   - Sector
>   - CEO Website URL

**Steps to Validate:**
- Log in to the admin and create your own post.
- To associate the article with a ticker symbol:
    - Make sure that "Post" is the active selection for the sidebar.
    - Locate the "Companies" taxonomy metabox in the sidebar.
    - Typing a few characters of your desired Company will trigger an auto-population dropdown. Select your company ticker from the list of available matches.
      If your desired company isn't listed that's okay, just finish typing the company name. Your company will be automatically created and available via auto-population the
      next time you need it. The expectation for this field is company ticker.
- Assign the post to category "Stock Recommendation".
- Publish your content.

---

> > ### Story 3: Create a Stock Recommendation archive page
> The Stock Recommendation archive page should include the following:
>
> - A list of links to all of the Stock Recommendation articles that have been published, in reverse chronological order (newest first), showing 10 at a time
> - Each Stock Recommendation should show the title of the article as well as the ticker symbol, e.g. “Buy Starbucks (NASDAQ:SBUX)”

**Steps to Validate:**
- Navigate to the [Stock Recommendation archive page](http://foolish-project.vagrant/category/stock-recommendation/)
- Notice that both requirements for this page have been met.

---

> > ### Story 4: Create a Company Page
> We want a page on the site for each company that we write about. The Company Page should include the following:
>
> - The name of the company and the company logo in the header
> - A description of the company
> - A side box or table that contains the following financial data, which will come from an API call (see note below):
>   - Price
>   - Price change
>   - Price change in percentage
>   - 52 week range
>   - Beta
>   - Volume
>   - Average
>   - Market Capitalisation
>   - Last Dividend (if any, otherwise display “N/A”)
> - If the company has been recommended, a list of links to the recommendation articles should be displayed under the header “Recommendations”, in reverse chronological order (newest first).
> - Any News articles should be listed under the header “Other Coverage” in reverse chronological order (newest first). If there are more than 10 articles, the user should be able to page through them. Subsequent pages should contain everything except the list of Recommendation articles.

**Steps to Validate:**
Company Pages are created dynamically when new Company taxonomy terms are added to the database. To test a company:
1. Go to the list of available companies at `Admin -> Posts -> Companies`
1. Select a company from the list and click the 'View' action that is available on hover.
    - Notice that the description of the company exists as the main content, with the company logo placed to the right.
    - Notice that company Financial Data is displayed in a table below the description.
    - Notice that Previous Recommendations exist in a callout box below the financial information.
    - Notice that below the previous recommendations, Other Coverage is displayed in a callout box.
        - Notice that users can paginate through the list of articles using the pagination links.
        - Notice that this list excludes articles posted in Previous Recommendations

---

## Tests and Code Quality
Unit tests and code quality tools have been made available for both the plugin and the theme. These tools use [Grumphp](https://github.com/phpro/grumphp)
to automate the execution of tasks such as PHP Unit, PHPMD, PHPCS, PHP Lint, etc. They run on a pre-commit hook.
You can see the full list by viewing `/plugins/foolish-company-data/grumphp.yml` for the plugin and `/themes/fool-theme/grumphp.yml` for the theme.

### Testing Setup
The theme and plugin use the [wp scaffold](https://developer.wordpress.org/cli/commands/scaffold/) wp-cli commands to bootstrap the testing suite.
Basically there's some setup that we need to do if you want to test locally. Instructions are below, but full documentation is available via the [Codex](https://make.wordpress.org/cli/handbook/misc/plugin-unit-tests/#running-tests-locally).

**To initialize the testing environment:**
1. SSH into your local WordPress environment.
1. Run the installation script found at `/plugins/foolish-company-data/bin/install-wp-tests.sh`.
   ```bash
   ./bin/install-wp-tests.sh wordpress_test root '' localhost latest
   ```
   The installation script first installs a copy of WordPress in the `/tmp` directory (by default) as well as the WordPress unit testing tools.
   Then it creates a database to be used while running tests. The parameters that are passed to `install-wp-tests.sh` setup the test database.
    - `wordpress_test` is the name of the test database (all data will be deleted!)
    - `root` is the MySQL user name
    - `''` is the MySQL user password
    - `localhost` is the MySQL server host
    - `latest` is the WordPress version; could also be `3.7`, `3.6.2` etc.

### Running the tests
You can manually fire Grumphp and execute all tests by running `./vendor/bin/grumphp run` from the desired directory root (theme or plugin).

To execute code quality tests individually you can use the available Composer tasks outlined in `composer.json`:
- `composer lint`
- `composer wpcs`
- `composer phpmd`

To manually run the unit tests:
- `./vendor/bin/phpunit --configuration=.phpunit.xml.dist --testdox`

## Callouts

- Apologies for making the assumption that your directory path will look like mine in `composer.json`. I should have used plugin-specific composer files as opposed to a global site file.
- I set a stretch goal of using transients to cache the data returned by the API, but ran out of time.
- Although Posts support adding multiple Companies, doing so is not supported with existing functionality nor outlined in the requirements. Each Post should only contain 1 company relationship.
- There are logs tracking API errors at `/public/wp-content/plugins/fool-company-data/logs/`. I left mine in the repo if you're interested.
- I'd considered using Guzzle for the API client but decided it was overkill for this project, as there's no OAuth or PUT's or POST's to deal with.
- If you're writing a filter for `the_title` but start testing before your logic before the final `return` statement is in place a lot of your posts will have a blank title and this will cause an infinite loop in some situations, which is super cool.

---

## Wrapping Up

Thank you for this opportunity, it was a fun challenge! It was a great mix of all the things that go into modern WordPress development.

I hope the installation goes well. After writing this documentation there were a few things that jumped out at me that I could have done differently to make the process easier...creating a plugin settings dashboard to hold the API key instead of using ACF for example... but I was already pushing time and wanted to respect the requirements.

There are also hard dependencies between the theme and the Foolish Company Data plugin. I'd have liked to have decoupled those more gracefully.
Actually there are about a million things I'd liked to have put more time into, but I think that's always the case about the things we create. But at some point we just have to let it go... so here it is, in all of its imperfect glory :)

Please feel free to hit me up anytime 24/7 with questions or if you run into issues, and best of luck on your search.

Peace,

Jason
jason@coolguy.org
574-903-3563
