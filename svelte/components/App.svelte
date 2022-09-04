<Content>
    <Grid>
        <Row>
            <Column>
                <Router url="{url}">
                    <Route path="message/:messageSid" let:params>
                        <Message messageSid="{ params.messageSid }"/>
                    </Route>
                    <Route path="/" component="{ Messages }"/>
                    <Route component="{PageNotFound}"/>
                </Router>
            </Column>
        </Row>
    </Grid>
</Content>

<script>
    import {Column, Content, Grid, Row} from 'carbon-components-svelte';
    import {Route, Router} from "svelte-routing";
    import Messages from "./Messages.svelte";
    import Message from "./Message.svelte";
    import PageNotFound from "./PageNotFound.svelte";

    export let url = "";
</script>