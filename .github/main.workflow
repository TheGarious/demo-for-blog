workflow "Travis CI" {
  on = "push"
  resolves = ["Travis CI"]
}

action "Travis CI" {
  uses = "BanzaiMan/travis-ci-action@master"
  secrets = ["TRAVIS_TOKEN"]
  env = {
    SLUG = "OWNER/REPO"
    SITE = "org"
  }
}
