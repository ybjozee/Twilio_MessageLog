<div class="centered">
    <Grid>
        <Row>
            <Column>
                <h1 class="error__heading">Error 404: Page Not Found</h1>
            </Column>
        </Row>
        <Row>
            <Column>
                <div class="centered">
                    <Link to="/">Return to dashboard</Link>
                </div>
            </Column>
        </Row>
    </Grid>
</div>

<style>
    .error__heading {
        color: red;
        font-size: 5rem;
    }

    .centered {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1%;
    }
</style>

<script>
    import {Column, Grid, Row} from 'carbon-components-svelte';
    import {Link} from 'svelte-routing'
</script>